<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use DB;

class SettingController extends Controller
{
	private $settingModel;

	public function __construct(Setting $settingModel)
	{
		$this->settingModel = $settingModel;
	}

    public function index () {
    	return view('Backend.Contents.setting.index');
    }

    public function getSetting (Request $request) {
    	$data = $this->settingModel->filterKey($request->key)
                                    ->buildCond()
                                    ->get();
    	foreach ($data as $key => $value) {
    		if (!empty($value)) {
    			$data[$key]->setting = json_decode($value->data);
    		}
    	}
    	return response()->json($data);
    }

    public function insertSetting(Request $request) {
    	$find = $this->settingModel::where('key', $request->key)
    								->first();
    	DB::beginTransaction();
    	try {
	    	if (empty($find)) {
				$this->settingModel->key     = $request->key;
				$this->settingModel->data    = $request->setting;
				$this->settingModel->save();
				DB::commit();
	    	} else {
	    		$find->key     = $request->key;
	    		$find->data    = $request->setting;
	    		$find->save();
	    		DB::commit();
	    	}
    	} catch (Exception $e) {
    		DB::rollback();
    	}
    }
}
