<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Business;
use App\Libs\Configs\KeyConfig;

class BuyController extends Controller
{
    private $businessModel;

	public function __construct(Business $business)
	{
		$this->businessModel = $business;
	}

    public function buyProcess() {

    	$buy_process = $this->businessModel->where('key', KeyConfig::CONST_BUY_PROCESS)
    										->first();

    	return view('Backend.Contents.purchase_business.process', array('buy_process' => $buy_process ));
    }

    public function gaurd() {

    	$guareantee = $this->businessModel->where('key', KeyConfig::CONST_BUYER_GUAREANTEE)
    										->first();

    	return view('Backend.Contents.purchase_business.guareantee',
    						array('guareantee'=>$guareantee) );
    }

    public function buyQa() {

        $buy_qa = $this->businessModel->where('key', KeyConfig::CONST_BUY_QA)
                                            ->first();

        return view('Backend.Contents.purchase_business.buy_qa',
                            array('buy_qa'=>$buy_qa) );
    }


    public function saveSell(Request $request) {
        
        $request->flash();
        $this->_validateSell($request);
    	$businessModel = $this->businessModel->where('key', $request->key)
    								->first();
    	DB::beginTransaction();
    	try {
	    	if (empty($businessModel)) {
				$this->businessModel->data             = $request->data;
				$this->businessModel->key              = $request->key;
				$this->businessModel->meta_title       = $request->meta_title;
				$this->businessModel->meta_name        = $request->meta_name;
				$this->businessModel->meta_description = $request->meta_description;
				$this->businessModel->meta_tag         = $request->meta_tag;
	    		$this->businessModel->save();
	    	} else {
	    		$businessModel->data             = $request->data;
				$businessModel->meta_title       = $request->meta_title;
				$businessModel->meta_name        = $request->meta_name;
				$businessModel->meta_description = $request->meta_description;
				$businessModel->meta_tag         = $request->meta_tag;
	    		$businessModel->save();
	    	}
    		DB::commit();
    		return redirect()->back()->with('buy-business', 'success');	
    	} catch (Exception $e) {
    		DB::rollback();
    	}
    }

    public function purchase() {
    	return view('Backend.Contents.purchase_business.index');
    }

    public function _validateSell($request) {
    	$this->validate($request, [
    		'data' => 'required',
    		'key'  => 'required'
    	], []);
    }
}
