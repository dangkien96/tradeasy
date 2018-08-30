<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EventOnline;
use DB, Mail;
use App\Libs\Functions\HTTP;
use Carbon\Carbon;
use App\Jobs\EmailJob;
use App\Models\Franchises;
use App\Models\FranchiseCategory;
use App\Models\BuyBusiness;

class FranchiseController extends Controller
{
	private $api_url;
    private $http;
	private $franchiseModel;
    private $franchiseCategoryModel;
    private $base_url;
    private $businessModel;
    private $mail_check_arr = array();

	public function __construct()
	{
        $this->api_url        = HTTP::API_URL;
        $this->http           = new HTTP();
        $this->franchiseModel = new Franchises();
        $this->businessModel  = new BuyBusiness();
        $this->base_url       = config('url.follow_url');
	}

    public function index() {
    	return view('Frontend.Contents.franchise.index');
    }

    public function detail($id, $slug) {
        $data = $this->franchiseModel->findOrFail($id);
    	return view('Frontend.Contents.franchise.detail', array('franchise'=> $data) );
    }

    private function _send($method, $url, $header = [], $params = []){
        //khoi tao curl
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    
        if(in_array(strtolower($method), [strtolower($this->http::HTTP_METHOD_POST), strtolower($this->http::HTTP_METHOD_PUT)]))
        {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params)); // $params = array
        }
        //them header
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); // $header = "key: value"
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($ch);
        return $result;
        $info = curl_getinfo($ch);
        curl_close($ch);
    }

    public function registerEvent () {
    	return view('Frontend.Contents.franchise.register_event');
    }


    public function addEvent (EventOnline $eventModel, Request $request) {
        if (!$request->check_rule) {
            return redirect()->back();
        }
        $request->flash();
        $this->validateInsert($request);

        $franchiseItem = $this->franchiseModel::find($request->franchise_id);

        DB::beginTransaction();
        try {
            $eventModel->name             = $request->name;
            $eventModel->number_of_people = $request->number;
            $eventModel->phone            = $request->phone;
            $eventModel->email            = $request->email;
            $eventModel->franchise_id     = @$franchiseItem->id;
            $eventModel->franchise_name   = @$franchiseItem->intro_2;
            $eventModel->save();

            $s_source="Email Enquiry";
            $t_uuid=uniqid("", true);

            DB::connection('mysql2')
                ->table('tbl_business_transfer')
                ->insert(array(
                    't_uuid'             => $t_uuid,
                    'post_date'          => Carbon::now(),
                    'type_id'            => 2,
                    'opportunities_id'   => @$franchiseItem->id,
                    'first_name'         => $request->name,
                    'phone_1'            => $request->phone,
                    'email'              => $request->email,
                    'business_nature_id' => 0,
                    'desc_2'             => "[ TRADEASY ] ".@$franchiseItem->intro_2,
                    'source'             => $s_source,
                    'character_1'        => @$franchiseItem->intro_2,

                    'member_create_date' => '0000-00-00 00:00:00',
                    'member_create_by'   => '0',
                    'member_modify_date' => '0000-00-00 00:00:00',
                    'member_modify_by'   => '0',
                    'modify_date'        => '0000-00-00 00:00:00',
                    'create_date'        => '0000-00-00 00:00:00',
                    'create_by'          => '0',
                    'modify_by'          => '0',
                    'deleted'            => '0',
                    'inactive'           => '0',
                    'status'             => '0',
                    ));
            $company = $request->input('company', 'TRADEASY');

            $params = [
                'name'           => $request->name,
                'phone'          => $request->phone,
                'email'          => $request->email, 
                'franchise_id'   => $request->franchise_id,
                'franchise_name' => @$franchiseItem->intro_2,
                'message'        => @$franchiseItem->desc_2,
                
                'intro'          => @$franchiseItem->intro_2,
                'code'           => @$franchiseItem->code,
                'transfer'       => @$request->number,
                'type'           => '講座/課程',

                'come_to'        => $s_source, 
                'company'        => $company,
            ]; 

            $opp_id = $request->input('franchise_id', -1);
            $url    = $this->base_url."follow_franchise.php?t_uuid=".$t_uuid."&ref1=".$opp_id; 

            EmailJob::dispatch($request->email, 'franchise_customer', $params, $params['company'], $params['company']." - Acquired Business");
            EmailJob::dispatch(config('mail.toMail'), 'franchise_ad', $params, $params['company'], $params['company']." - Acquired Business");

            $this->_sendMailUserFlow($opp_id, $t_uuid, $params, $url);
            $this->_sendMailAd($opp_id, $t_uuid, $params, $url);
            $this->_sendExclusive($opp_id,  $request->phone, $t_uuid, $params, $url);
            $request->flush();
            DB::commit();
            return redirect()->back()->with('event', 'success');
        } catch (Exception $e) {
            return redirect()->back();
        }
    }

    public function _sendMailUserFlow($opp_id, $uuid, $params, $url) {
        $data = DB::connection('mysql2')->table('tbl_opportunities_franchise_follow_user')
                                        ->join('sys_user', 'tbl_opportunities_franchise_follow_user.user_id', '=', 'sys_user.id')
                                        ->join('tbl_opportunities_franchise', 'tbl_opportunities_franchise_follow_user.opp_id', '=',  'tbl_opportunities_franchise.id')
                                        ->select(DB::raw('ADDTIME(now(),100*tbl_opportunities_franchise_follow_user.wait_time) as start_time'), 'sys_user.id', 'sys_user.user', 'sys_user.email')
                                        ->where(array(
                                            array('tbl_opportunities_franchise.active', 1),
                                            array('sys_user.deleted', 0),
                                            array('sys_user.email', '<>', ''),
                                            array('tbl_opportunities_franchise_follow_user.opp_id', $opp_id)      
                                        ))
                                        ->first();
        $this->mail_check_arr[] = @$data->email;
        $params['user']         = @$data->user;
        $params['link']         = $url."&ref2=".@$data->id;
        $params['start_time']   = Carbon::now();

        if (!empty($data)) {
            DB::connection('mysql2')
                    ->table('tbl_opportunities_mail_user_franchise')
                    ->insert(array( array(
                            'opp_id'     => $opp_id, 
                            'user_id'    => $data->id, 
                            'start_time' => $data->start_time, 
                            't_uuid'     => $uuid),
                    ));

            EmailJob::dispatch(@$data->email, 'franchise', $params, $params['company'], $params['company']." Acquired Business");
        }
    }

    public function _sendMailAd ($opp_id, $uuid, $params, $url) {
        $data = DB::connection('mysql2')->table('sys_user_group')
                                        ->join('sys_user', 'sys_user_group.id', '=', 'sys_user.sys_user_group_id')
                                        ->select('sys_user.id', 'sys_user.user', 'sys_user.email')
                                        ->where(array(
                                                array('sys_user.active', 1),
                                                array('sys_user.deleted', 0),
                                                array('sys_user.email', '<>', ''),
                                            ))
                                        ->whereIn('sys_user_group.name_2', ['System Administrator', 'CSO'])
                                        ->get();
        $params['start_time'] = Carbon::now();
        foreach ($data as $key => $value) {
            if (!in_array(@$value->email, $this->mail_check_arr)) {
                $this->mail_check_arr[] = @$value->email;

                DB::connection('mysql2')
                    ->table('tbl_opportunities_mail_user_franchise')
                    ->insert(array(array(
                            'opp_id'     => $opp_id, 
                            'user_id'    => $value->id, 
                            'start_time' => Carbon::now(), 
                            't_uuid'     => $uuid), 
                ));
                $params['user']  = @$value->user;
                $params['link']  = $url."&ref2=".@$value->id;

                EmailJob::dispatch(@$value->email, 'franchise', $params, $params['company'], $params['company']." Acquired Business");
            }
        }
        return $data;
    }

    public function _sendExclusive($opp_id, $phone, $uuid, $params, $url) {
        $exclusive_business = DB::connection('mysql2')
                            ->table('tbl_customer_exclusive_salesman')
                            ->join('sys_user', 'tbl_customer_exclusive_salesman.user_id', '=', 'sys_user.id')
                            ->select('sys_user.id' , 'sys_user.user', 'sys_user.email', 'tbl_customer_exclusive_salesman.overdue_time')
                            ->where(array(
                                array('tbl_customer_exclusive_salesman.overdue_time', '>=', Carbon::now()),
                                array('tbl_customer_exclusive_salesman.customer_tel', $phone),
                            ))
                            ->first();
        if (!empty($exclusive_business)) {
            $email_user = DB::connection('mysql2')
                            ->table('tbl_opportunities_mail_user')
                            ->select(DB::raw('count(0) as count'))
                            ->where(array(
                                array('user_id', $exclusive_business->id),
                                array('t_uuid', $uuid),
                            ))
                            ->first();
            if ($email_user->count == 0) {
                DB::connection('mysql2')
                                ->table('tbl_opportunities_mail_user')
                                ->insert(array(
                                    'opp_id'     => $opp_id,
                                    'user_id'    => $exclusive_business->id,
                                    'start_time' => Carbon::now(),
                                    't_uuid'     => $uuid,
                                ));
                $params['user']       = @$exclusive_business->user;
                $params['link']       = $url."&ref2=".@$exclusive_business->id;
                $params['start_time'] = Carbon::now();

                EmailJob::dispatch(@$exclusive_business->email, 'franchise', $params, $params['company'], $params['company']." Acquired Business");
            }
        }
    }

    public function hotFranchise(){
        $data = $this->franchiseModel->select('photo_1', 'intro_2', 'teacher_introduction', 'id', 'code')
                                    ->limit(3)->orderBy('sort_no', 'desc')
                                    ->get();
        return $data;
    }


    public function validateInsert($request) {
        $this->validate($request, [
            'name'             => 'between: 1, 100',
            'number_of_people' => 'between: 1, 100',
            'phone'            => 'between: 1, 100',
            'email'            => 'between: 1, 250|email',
            'franchise_id'     => 'required',
            'franchise_name'   => 'between: 1, 100',
            'captcha'          => 'required| captcha'
        ], [], array(
            'name'             => trans('fe_business.name'),
            'number_of_people' => trans('fe_business.number'),
            'phone'            => trans('fe_business.phone'),
            'email'            => trans('fe_business.email'),
            'franchise_id'     => trans('fe_business.franchise'),
            'franchise_name'   => trans('fe_business.franchise'),
            'captcha'          => trans('fe_business.captcha'),
        ));
    }
}
