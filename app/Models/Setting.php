<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\MyModel;

class Setting extends MyModel
{
    protected $table = "setting";

    public function filterKey($params) {
    	if (!empty($params)) {
    		$this->setFunctionCond('where', ['key', $params]);
    	}
    	return $this;
    }
}
