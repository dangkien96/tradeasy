<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\MyModel;

class Franchises extends MyModel
{
	protected $connection = "mysql2";
    protected $table = "tbl_opportunities_franchise";

    public function filterCategory1($params) {
    	if (!empty($params)) {
    		// $this->setFunctionCond('where', array('cate1_id', $params), array('deleted', 0), array('active', 1));
    		$this->setFunctionCond('whereRaw', ["cate1_id = '$params' and deleted = 0 and active = 1"]);
    	}
    	return $this;
    }

    public function filterCategory2($params1, $params2) {
    	if (!empty($params1)) {
    		// $this->setFunctionCond('where', array('cate2_id', $params1), array('deleted', 0), array('active', 1));
    		$this->setFunctionCond('whereRaw', ["cate2_id = '$params1' and deleted = 0 and active = 1"]);

    		if (!empty($params2)) {
	    		$this->setFunctionCond('orWhere', ['cate3_id', $params2]);
	    		$this->setFunctionCond('where', ['deleted', 0]);
	    		$this->setFunctionCond('where', ['active', 1]);
    		}
    	}
    	return $this;
    }
}
