<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BusinessDB2;
use DB;

class BusinessController extends Controller
{
	private $businessModel;
	public function __construct(BusinessDB2 $business)
	{
		$this->businessModel = $business;
	}

	public function business (Request $request) {
		$request->flash();
		
		$location_name      = $request->input('location_name', array());
		$nature_name        = $request->input('nature_name', array());
		$start_rent         = $request->input('start_rent');
		$end_rent           = $request->input('end_rent');
		$start_profit       = $request->input('start_profit');
		$end_profit         = $request->input('end_profit');
		$start_premise_size = $request->input('start_premise_size');
		$end_premise_size   = $request->input('end_premise_size');
		$money_basic        = $request->input('money_basic');
		if (!empty($location_name)) {
			$location_name[] = -100;
		}
		$data = $this->businessModel
					 ->filterLocation($location_name)
					 ->filterNature($nature_name)
					 ->filterRent((int)$start_rent, (int)$end_rent)
					 ->filterProfit((int)$start_profit,(int)$end_profit)
					 ->filterPremiseSize((int)$start_premise_size,(int)$end_premise_size)
					 ->filterMoneyBasic($money_basic)
					 ->buildCond()					 
					 ->select('id', 'code', 'intro_2', 'reference_profits', 'investment', 'Premise_Size', 'location_id')
					 ->with(['locations' => function($query) {
						    $query->select('id', 'name_2');
						}])
					 ->where([
					  array('status', 0),
		              array('deleted', 0),
		              array('active', 1)
		          	])
					 ->orderBy('sort_no', 'desc')
					 ->paginate(15);
		// echo "<pre>";
		// var_dump($data);
		// var_dump($data->toSql());
		// return 123;
		// print_r($data);
    	return view('Frontend.Contents.business.index', array('businessNews' => $data) );
    }


    public function businessDetail($id, Request $request) {
    	$data = $this->businessModel->where('id', $id)
    								->with(['locations' => function($query) {
    									$query->select('id', 'name_2');
    								}])
    								->with(['natures' => function($query) {
    									$query->select('id', 'name_2');
    								}])
    								->first();
    	// echo "<pre>";
    	// print_r($data);
    	return view('Frontend.Contents.business.detail', array('business' => $data));
    }

}
