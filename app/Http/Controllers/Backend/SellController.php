<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Business;
use App\Models\SellBusiness;
use App\Libs\Configs\KeyConfig;

class SellController extends Controller
{
	private $businessModel;

	public function __construct(Business $business, SellBusiness $sellBusiness)
	{
        $this->businessModel     = $business;
        $this->sellBusinessModel = $sellBusiness;
	}

    public function sellProcess() {

    	$sell_process = $this->businessModel->where('key', KeyConfig::CONST_KEY_SELL_PROCESS)
    										->first();

    	return view('Backend.Contents.sell_business.process', array('sell_process'=>$sell_process ));
    }

    public function sellCriteria() {

    	$sell_process = $this->businessModel->where('key', KeyConfig::CONST_SELL_CRITERIA)
    										->first();

    	return view('Backend.Contents.sell_business.sell_criteria',
    						array('sell_process'=>$sell_process) );
    }

    public function sellQa() {

        $sell_process = $this->businessModel->where('key', KeyConfig::CONST_QA_SELL_BUSINESS)
                                            ->first();

        return view('Backend.Contents.sell_business.sell_qa',
                            array('sell_process'=>$sell_process) );
    }

    public function sellValuation() {

        $sell_process = $this->businessModel->where('key', KeyConfig::CONST_BUSINESS_VALUATION)
                                            ->first();

        return view('Backend.Contents.sell_business.business_valuation',
                            array('sell_process'=>$sell_process) );
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
    		return redirect()->back();	
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

     public function register () {
        return view('Backend.Contents.sell_business.register');
    }

    public function list (Request $request) {
        $data = $this->sellBusinessModel->filterName($request->freetext)
                                    ->filterPhone($request->freetext)
                                    ->filterEmail($request->freetext)
                                    ->filterProfit($request->freetext)
                                    ->filterNature($request->freetext)
                                    ->buildCond()
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10);
        return response()->json($data);
    }
}
