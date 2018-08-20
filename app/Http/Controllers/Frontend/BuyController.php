<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BuyBusiness;
use App\Models\BusinessDB2;
use App\Models\BusinessNature;
use App\Models\Location;
use App\Mail\SendMail;
use App\Libs\Functions\HTTP;
use App\Jobs\EmailJob;

use Carbon\Carbon;
use DB, Mail;

class BuyController extends Controller
{
    private $buyBusinessModel, $businessModel, $http;
    private $mail_check_arr = array();
    private $base_url = "http://transoft.tk/";

    public function __construct(BuyBusiness $buyBusiness, BusinessDB2 $business, HTTP $http)
    {
        $this->buyBusinessModel = $buyBusiness; 
        $this->businessModel    = $business;
        $this->http             = $http;
    }

	public function buy (Request $request) {

        $data = $this->businessModel->select('id', 'intro_2', 'code')
                                    ->where('id', $request->business)
                                    ->first();

		return view('Frontend.Contents.buy-business.buy', array('business' => $data));
	}
    public function process () {
    	return view('Frontend.Contents.buy-business.process');
    }

    public function qa () {
    	return view('Frontend.Contents.buy-business.qa');
    }

    public function guard () {
    	return view('Frontend.Contents.buy-business.safeguard');
    }

    public function buyBusiness(Request $request) {
        ini_set('max_execution_time', 300); 
        $request->flash();
        $this->_validateBuy($request);
        DB::beginTransaction();
        try {
            // Insert Database buy_business of backend mysql 1
            $this->buyBusinessModel->name          = $request->name;
            $this->buyBusinessModel->phone         = $request->phone;
            $this->buyBusinessModel->email         = $request->email;
            $this->buyBusinessModel->city          = $request->location_name;
            $this->buyBusinessModel->nature        = $request->industry;
            $this->buyBusinessModel->investment    = $request->investment;
            $this->buyBusinessModel->message       = $request->message;
            $this->buyBusinessModel->business_name = $request->business_name;
            $this->buyBusinessModel->business_code = $request->business_code;
            $this->buyBusinessModel->business_id   = $request->business_id;
            $this->buyBusinessModel->save();
            
            //Insert data tbl_business_transfer of business crm mysql 2
            $t_uuid=uniqid("",true);
            $s_source='Email Enquiry';
            $tbl_transfer = DB::connection('mysql2')
                            ->table('tbl_business_transfer')
                            ->insert([[
                            't_uuid'             => $t_uuid,
                            'post_date'          => Carbon::now(),
                            'type_id'            => 1,
                            'opportunities_id'   => $request->input('business_id', 0),
                            'first_name'         => $request->name,
                            'phone_1'            => $request->phone,
                            'email'              => $request->email,
                            'business_nature_id' => $request->industry,
                            'investment'         => $request->investment,
                            'source'             => $s_source,
                            'desc_2'             => $request->message,
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
                            ]]);

            // Params in view mail
            $params = [
                'intro'                => $request->business_name,
                'code'                 => $request->business_code,
                'region_name'          => @Location::find($request->location_name)->name_2,
                'business_nature_name' => @BusinessNature::find($request->industry)->name_2,
                'investment'           => $request->investment,
                'company'              => $request->input('company', "TRADEASY"),
                ];

            $url   = $this->base_url."follow.php?t_uuid=".$t_uuid."&ref1=".$request->input('business_id', -1); 

            // Function send mail
            $mail  = $this->_sendMailUserFlow($request->input('business_id', -1), $t_uuid, $params, $url);
            $mail2 = $this->_sendMailSetting($request->input('business_id', -1), $t_uuid, $params, $url);
            $mail3 = $this->_sendMailAd($request->input('business_id', -1), $t_uuid, $params, $url);
            $mail4 = $this->_sendExclusive($request->input('business_id', -1), $request->phone, $t_uuid, $params, $url);
            DB::commit();
            $request->flush();
            return redirect()->back()->with('buy-business', 'success');

        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function _sendMailUserFlow($opp_id, $uuid, $params, $url) {
        $data = DB::connection('mysql2')->table('tbl_opportunities')
                                        ->join('sys_user', 'tbl_opportunities.Followed1_By', '=', 'sys_user.id')
                                        ->select('sys_user.id', 'sys_user.user', 'sys_user.email')
                                        ->where(array(
                                            array('sys_user.active', 1),
                                            array('sys_user.deleted', 0),
                                            array('sys_user.email', '<>', ''),
                                            array('tbl_opportunities.id', $opp_id)      
                                        ))
                                        ->first();

        $this->mail_check_arr[] = @$data->email;

        $params['user']       = @$data->user;
        $params['link']       = $url."&ref2=".@$data->id;
        $params['start_time'] = Carbon::now();
        if (!empty($data)) {
            DB::connection('mysql2')
                    ->table('tbl_opportunities_mail_user')
                    ->insert(array( array(
                            'opp_id'     => $opp_id, 
                            'user_id'    => $data->id, 
                            'start_time' => Carbon::now(), 
                            't_uuid'     => $uuid),
                    ));
            EmailJob::dispatch(@$data->email, 'buy_business', $params, $params['company'], $params['company']."Acquired Business");
        }
    }

    public function _sendMailSetting($opp_id, $uuid, $params, $url) {
        $business_imvestment = $this->businessModel->select("investment")->find($opp_id);

        if ($opp_id > 0) {
            $data =  DB::connection('mysql2')->table('tbl_mailsetting')
                                            ->join('sys_user', 'tbl_mailsetting.user_id', '=', 'sys_user.id')
                                            ->select(DB::raw('ADDTIME(now(),100*tbl_mailsetting.wait_time) as start_time'), 'sys_user.id', 'sys_user.user', 'sys_user.email')
                                            ->where(array(
                                                array('sys_user.active', 1),
                                                array('sys_user.deleted', 0),
                                                array('sys_user.email', '<>', ''),
                                                array('tbl_mailsetting.type', "B")
                                            ))
                                            ->where(function($q) use ($business_imvestment) {
                                                $q->where('sys_user.max_follow_amt', ">=", $business_imvestment->investment)
                                                  ->orWhere('sys_user.max_follow_amt', "=", 0);
                                              })
                                            ->get();

        } else {
            $data =  DB::connection('mysql2')->table('tbl_mailsetting')
                                            ->join('sys_user', 'tbl_mailsetting.user_id', '=', 'sys_user.id')
                                            ->select(DB::raw('ADDTIME(now(),100*tbl_mailsetting.wait_time) as start_time'), 'sys_user.id', 'sys_user.user', 'sys_user.email')
                                            ->where(array(
                                                array('sys_user.active', 1),
                                                array('sys_user.deleted', 0),
                                                array('sys_user.email', '<>', ''),
                                                array('tbl_mailsetting.type', "B2")
                                            ))
                                            ->get();
        }
        
        foreach ($data as $key => $value) {
            if (!in_array(@$value->email, $this->mail_check_arr)) {
                $this->mail_check_arr[] = $value->email;
                DB::connection('mysql2')
                    ->table('tbl_opportunities_mail_user')
                    ->insert(array(array(
                            'opp_id'     => $opp_id, 
                            'user_id'    => $value->id, 
                            'start_time' => $value->start_time, 
                            't_uuid'     => $uuid),
                ));
                $params['user']       = @$value->user;
                $params['link']       = $url."&ref2=".@$value->id;
                $params['start_time'] = $value->start_time;

                EmailJob::dispatch(@$value->email, 'buy_business', $params, $params['company'], $params['company']." Acquired Business");
            }
        }
        // EmailJob::dipacth($receiver, $type, $params, $company, $subject);
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
                    ->table('tbl_opportunities_mail_user')
                    ->insert(array(array(
                            'opp_id'     => $opp_id, 
                            'user_id'    => $value->id, 
                            'start_time' => Carbon::now(), 
                            't_uuid'     => $uuid), 
                ));
                $params['user']  = @$value->user;
                $params['link']  = $url."&ref2=".@$value->id;

                EmailJob::dispatch(@$value->email, 'buy_business', $params, $params['company'], $params['company']."Acquired Business");
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
                                array('t_uuid', $t_uuid),
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
                $params['user']  = @$value->user;
                $params['link']  = $url."&ref2=".@$value->id;
                $params['start_time'] = Carbon::now();

                EmailJob::dispatch(@$value->email, 'buy_business', $params, $params['company'], $params['company']."Acquired Business");
            }
        }

    }

    public function _validateBuy($request) {
        $this->validate($request, [
            'name'          => 'between: 1, 150',
            'phone'         => 'between: 1, 20',
            'email'         => 'email| between: 1, 150',
            'location_name' => 'between: 1, 150',
            'industry'      => 'between: 1, 150',
            'investment'    => 'between: 1, 150',
            'captcha'       => 'between: 1, 150|captcha'
        ]);
    }
}

