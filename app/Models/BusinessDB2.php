<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\MyModel;
use DB;

class BusinessDB2 extends MyModel
{
    protected $connection = "mysql2";
    protected $table = "tbl_opportunities";

    public $timestamp = false;

    public function locations() {
        return $this->belongsTo('App\Models\Location', 'location_id', 'id');
    }

    public function natures() {
         return $this->belongsTo('App\Models\BusinessNature', 'business_nature_id', 'id');
    }

    public function images() {
         return $this->hasMany('App\Models\BusinessImage', 'cat_id', 'id');
    }

    public function filterNature($params) {
    	if (!empty($params)) {
    		$this->setFunctionCond('whereIn', ['tbl_opportunities.business_nature_id', $params]);
    	}
    	return $this;
    }

    public function filterLocation($params) {
    	if (!empty($params)) {
    		$this->setFunctionCond('whereIn', ['tbl_opportunities.location_id', $params]);
    	}
    	return $this;
    }

    public function filterCode($params) {
        if (!empty($params)) {
            $this->setFunctionCond('where', ['tbl_opportunities.code', "like", "%".$params."%"]);
        }
        return $this;
    }

     public function filterFreeText($params) {
        if (!empty($params)) {
            $this->setFunctionCond('where', ['tbl_opportunities.intro_2', "like", "%".$params."%"]);
            // $this->setFunctionCond('whereOr', ['decs_2', "like", "%".$params."%"]);
        }
        return $this;
    }

    public function filterProfit($start, $end) {
    	if (!empty($start) || !empty($end)) {
            if (!empty($start)) {
                $this->setFunctionCond('where', [DB::raw('REPLACE(REPLACE(REPLACE(reference_profits,"HKD",""),"$",""),",", "")'), ">=", $start]);
            }
            if (!empty($end)) {
                $this->setFunctionCond('where', [DB::raw('REPLACE(REPLACE(REPLACE(reference_profits,"HKD",""),"$",""),",", "")' ), "<=", $end]);
            }
            
        }
    	return $this;
    }

    public function filterRent($start, $end) {
    	if (!empty($start) || !empty($end)) {
    		if (!empty($start)) {
    			$this->setFunctionCond('where', [DB::raw('REPLACE(REPLACE(REPLACE(Rent,"HKD",""),"$",""),",", "")'), ">=", $start]);
    		}
            if (!empty($end)) {
    			$this->setFunctionCond('where', [DB::raw('REPLACE(REPLACE(REPLACE(Rent,"HKD",""),"$",""),",", "")' ), "<=", $end]);
    		}
    		
    	}
    	return $this;
    }

    public function filterPremiseSize($start, $end) {
        if (!empty($start) || !empty($end)) {
            if (!empty($start)) {
                $this->setFunctionCond('where', [DB::raw("REPLACE(REPLACE(REPLACE(Premise_Size,'平方呎',''),'呎',''),',','')"), ">=", $start]);
            }
            if (!empty($end)) {
                $this->setFunctionCond('where', [DB::raw("REPLACE(REPLACE(REPLACE(Premise_Size,'平方呎',''),'呎',''),',','')" ), "<=", $end]);
            }
            
        }
        return $this;
    }

    public function filterMoneyBasic($value) {
        switch ($value) {
            case '1':
                $start = ""; 
                $end   = 300000;
                break;
            case '2':
                $start = 300000; 
                $end   = 500000;
                break;
            case '3':
                $start = 500000; 
                $end   = 700000;
                break;
            case '4':
                $start = 700000; 
                $end   = 1000000;
                break;
            case '5':
                $start = 1000000; 
                $end   = 1500000;
                break;
            case '6':
                $start = 1500000; 
                $end   = 2000000;
                break;
            case '7' : 
                $start = 2000000; 
                $end   = "";
            default:
                $start = ""; 
                $end   = "";
                break;
        }
        if (!empty($start) || !empty($end)) {
            if (!empty($start)) {
                $this->setFunctionCond('where', ["investment", ">=", (int)$start]);
            }
            if (!empty($end)) {
                $this->setFunctionCond('where', ["investment", "<=", (int)$end]);
            }
            
        }
        return $this;
    }

    
}
