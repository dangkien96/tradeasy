<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchiseCategory extends Model
{
	protected $connection = "mysql2";
    protected $table = "tbl_category1";

    public function franchises() {
    	// return $this->hasMany('App\Models\Franchise', 'id', '');
    }
}
