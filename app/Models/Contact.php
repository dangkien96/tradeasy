<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MyModel;

class Contact extends MyModel
{
    protected $table = "contact";

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
}
