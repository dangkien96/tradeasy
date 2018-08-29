<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Mail;
use App\Models\Contact;
use Carbon\Carbon;
use App\Jobs\EmailJob;

class ContactController extends Controller
{
	private $contactModel;
    private $mail_check_arr = array();
    private $base_url = "http://transoft.tk/";

    public function contact () {
    	return view('Frontend.Contents.contact.index');
    }

    public function __construct(Contact $contactModel, Request $request)
    {
    	$this->contactModel = $contactModel;
    }
    public function addContact (Request $request) {
        $request->flash();
        $this->validateContact($request);
    	DB::beginTransaction();
    	try {
			$this->contactModel->name    = $request->name;
			$this->contactModel->email   = $request->email;
			$this->contactModel->phone   = $request->phone;
			$this->contactModel->message = $request->message;
			$this->contactModel->save();

            $s_source="Email Enquiry";
            $t_uuid=uniqid("",true);

            DB::connection('mysql2')
                ->table('tbl_business_transfer')
                ->insert(array(
                    't_uuid'             => $t_uuid,
                    'post_date'          => Carbon::now(),
                    'type_id'            => 3,
                    'opportunities_id'   => 0,
                    'first_name'         => $request->name,
                    'phone_1'            => $request->phone,
                    'email'              => $request->email,
                    'desc_2'             => "[ TRADEASY ] ".$request->message,
                    'source'             => $s_source,
                    'business_nature_id' => 0,

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
                'name'    => $request->name,
                'phone'   => $request->phone,
                'email'   => $request->email,  
                'message' => $request->message,
                'type'    => 'Contact',
                'company' => $company,
                'come_to' => $s_source,
            ]; 
            $url   = $this->base_url."follow_general.php?t_uuid=".$t_uuid."&type=S"; 
            EmailJob::dispatch($request->email, 'contact_customer', $params, $params['company'], $params['company']." Acquired Business");

            EmailJob::dispatch(config('mail.toMail'), 'contact_ad', $params, $params['company'], $params['company']." Acquired Business");
            
            $this->_sendMailSetting($t_uuid, $params, $url);
            $this->_sendMailAd($t_uuid, $params, $url);
            $this->_sendExclusive(-1, $request->phone, $t_uuid, $params, $url);

            $request->flush();
            DB::commit();
    		return redirect()->back()->with('contact', 'success');
    	} catch (Exception $e) {
    		DB::rollback();
    	}
    }

    public function _sendMailSetting ($uuid, $params, $url) {
        $data =  DB::connection('mysql2')->table('tbl_mailsetting')
                                        ->join('sys_user', 'tbl_mailsetting.user_id', '=', 'sys_user.id')
                                        ->select(DB::raw('ADDTIME(now(),100*tbl_mailsetting.wait_time) as start_time'), 'sys_user.id', 'sys_user.user', 'sys_user.email')
                                        ->where(array(
                                            array('sys_user.active', 1),
                                            array('sys_user.deleted', 0),
                                            array('sys_user.email', '<>', ''),
                                            array('tbl_mailsetting.type', "S")
                                        ))
                                        ->get();

        foreach ($data as $key => $value) {
            if (!in_array(@$value->email, $this->mail_check_arr)) {
                $this->mail_check_arr[] = $value->email;
                DB::connection('mysql2')
                    ->table('tbl_general_mail_user')
                    ->insert(array(array(
                            'type'       => "C",
                            'user_id'    => $value->id, 
                            'start_time' => $value->start_time, 
                            't_uuid'     => $uuid),
                ));
                $params['name']       = @$value->user;
                $params['link']       = $url."&ref2=".@$value->id;
                $params['start_time'] = $value->start_time;

                EmailJob::dispatch(@$value->email, 'sell', $params, $params['company'], $params['company']." Acquired Business");
            }
        }
    }

    public function _sendMailAd ($uuid, $params, $url) {
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
                    ->table('tbl_general_mail_user')
                    ->insert(array(array(
                            'type'       => "C", 
                            'user_id'    => $value->id, 
                            'start_time' => Carbon::now(), 
                            't_uuid'     => $uuid), 
                ));
                $params['name'] = @$value->user;
                $params['link'] = $url."&ref2=".@$value->id;

                EmailJob::dispatch(@$value->email, 'sell', $params, $params['company'], $params['company']." Acquired Business");
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
                $params['name']       = @$value->user;
                $params['link']       = $url."&ref2=".@$value->id;
                $params['start_time'] = Carbon::now();

                EmailJob::dispatch(@$value->email, 'sell', $params, $params['company'], $params['company']." Acquired Business");
            }
        }
    }

    public function validateContact($request) {
    	$this->validate($request, [
			'name'  => 'between: 1,250',
			'phone' => 'between: 1,20',
			'email' => 'between: 1,250|email',
			'captcha' => 'between: 1,250|captcha',
    	], [
    	], array(
            'name'     => trans('fe_business.name'),
            'phone'    => trans('fe_business.phone'),
            'email'    => trans('fe_business.email'),
            'captcha'  => trans('fe_business.captcha'),
        ));
    }
}

