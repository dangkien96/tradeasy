<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Business;
use App\Libs\Configs\KeyConfig;


class StartUpController extends Controller
{
	private $businessModel;

	public function __construct(Business $business)
	{
		$this->businessModel = $business;
	}

    public function startUp () {
    	$statup = $this->businessModel->where('key', KeyConfig::CONST_START_UP)
    										->first();

    	return view('Backend.Contents.start_up.index', array('startup'=>$statup ));
    }

     public function saveStartUp(Request $request) {
        
        $request->flash();
        $this->_validateStartUp($request);
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
    		$request->flush();
    		return redirect()->back();	
    	} catch (Exception $e) {
    		DB::rollback();
    	}
    }

    public function _validateStartUp($request) {
    	$this->validate($request, [
    		'data' => 'required',
    		'key'  => 'required'
    	], []);
    }
}
