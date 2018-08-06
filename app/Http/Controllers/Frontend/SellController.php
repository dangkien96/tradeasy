<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SellBusiness;
use DB;

class SellController extends Controller
{
    private $sellBusinessModel;

    public function __construct(SellBusiness $sellBusiness)
    {
        $this->sellBusinessModel = $sellBusiness;    
    }

    public function sell (){
        return view('Frontend.Contents.sell-business.sell');
    }

    public function process (){
    	return view('Frontend.Contents.sell-business.process');
    }

    public function qa (){
    	return view('Frontend.Contents.sell-business.qa');
    }

    public function criteria (){
    	return view('Frontend.Contents.sell-business.criteria');
    }

    public function valuation (){
    	return view('Frontend.Contents.sell-business.valuation');
    }

    public function sellBusiness(Request $request) {

        $request->flash();
        $this->_validateSell($request);
        DB::beginTransaction();
        try {
            $this->sellBusinessModel->name       = $request->name;
            $this->sellBusinessModel->phone      = $request->phone;
            $this->sellBusinessModel->email      = $request->email;
            $this->sellBusinessModel->profit     = $request->profit;
            $this->sellBusinessModel->nature     = $request->industry;
            $this->sellBusinessModel->imvestment = $request->investment;
            $this->sellBusinessModel->message    = $request->message;
            $this->sellBusinessModel->save();
            DB::commit();
            $request->session()->flush();
            return redirect()->back()->with('sell-business', 'success');
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function _validateSell($request) {
        $this->validate($request, [
            'name'       => 'between: 1, 150',
            'phone'      => 'between: 1, 20',
            'email'      => 'email| between: 1, 150',
            'profit'     => 'between: 1, 150',
            'industry'   => 'between: 1, 150',
            'investment' => 'between: 1, 150',
            'captcha'    => 'between: 1, 150|captcha'
        ]);
    }
}
