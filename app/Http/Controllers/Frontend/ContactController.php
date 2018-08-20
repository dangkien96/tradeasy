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
                    'desc_2'             => $request->message,
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

            EmailJob::dispatch($request->email, 'contact_customer', $params, $params['company'], $params['company']." Acquired Business");

            EmailJob::dispatch(config('mail.toMail'), 'contact_ad', $params, $params['company'], $params['company']." Acquired Business");

            // Mail::to(config('mail.toMail'))
                    // ->send(new SendMail('contact',  $params, 'Transoft', 'Contact Tradeasy') );
            DB::commit();
    		return redirect()->back()->with('contact', 'success');
    	} catch (Exception $e) {
    		DB::rollback();
    	}
    	


    }

    public function validateContact($request) {
    	$this->validate($request, [
			'name'  => 'between: 1,250',
			'phone' => 'between: 1,20',
			'email' => 'between: 1,250|email',
			'captcha' => 'between: 1,250|captcha',
    	], [
    	]);
    }
}

