<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Mail;
use App\Models\Contact;
use App\Mail\SendMail;

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
    	DB::beginTransaction();
    	try {
			$this->contactModel->name    = $request->name;
			$this->contactModel->email   = $request->email;
			$this->contactModel->phone   = $request->phone;
			$this->contactModel->message = $request->message;
			$this->contactModel->save();
    		
            $params = [
                'name'    => $request->name,
                'phone'   => $request->phone,
                'email'   => $request->email,  
                'message' => $request->message,
                'type'    => 'Contact',
            ]; 
            Mail::to(config('mail.toMail'))
                    ->send(new SendMail('contact',  $params, 'Transoft', 'Contact Tradeasy') );
            DB::commit();
    		return redirect()->back()->with('contact', 'success');
    	} catch (Exception $e) {
    		DB::rollback();
    	}
    	


    }

    public function validateContact() {
    	$this->validate($request, [
			'name'  => 'between: 1,250',
			'phone' => 'between: 1,20',
			'email' => 'between: 1,250|email',
			'captcha' => 'between: 1,250|captcha',
    	], [
    	]);
    }
}

