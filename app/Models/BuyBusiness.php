<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MyModel;

class BuyBusiness extends MyModel
{
    protected $table = "buy_business";

    public function filterName($params) {
    	if (!empty($params)) {
    		$this->setFunctionCond('orWhere', ['name', 'like', '%'.$params.'%']);
    	}
    	return $this;
    }

    public function filterPhone($params) {
    	if (!empty($params)) {
    		$this->setFunctionCond('orWhere', ['phone', 'like', '%'.$params.'%']);
    	}
    	return $this;
    }

    public function filterEmail($params) {
    	if (!empty($params)) {
    		$this->setFunctionCond('orWhere', ['email', 'like', '%'.$params.'%']);
    	}
    	return $this;
    }

    public function filterCity($params) {
    	if (!empty($params)) {
    		$this->setFunctionCond('orWhere', ['city', 'like', '%'.$params.'%']);
    	}
    	return $this;
    }

    public function filterNature($params) {
    	if (!empty($params)) {
    		$this->setFunctionCond('orWhere', ['nature', 'like', '%'.$params.'%']);
    	}
    	return $this;
    }

}
