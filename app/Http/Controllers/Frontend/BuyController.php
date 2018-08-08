<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BuyBusiness;
use DB;
use App\Models\BusinessDB2;

class BuyController extends Controller
{
    private $buyBusinessModel, $businessModel;
    public function __construct(BuyBusiness $buyBusiness, BusinessDB2 $business)
    {
        $this->buyBusinessModel = $buyBusiness; 
        $this->businessModel    = $business;
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

        $request->flash();
        $this->_validateBuy($request);
        DB::beginTransaction();
        try {
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
            DB::commit();
            $request->session()->flush();
            return redirect()->back()->with('buy-business', 'success');
        } catch (Exception $e) {
            DB::rollback();
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

