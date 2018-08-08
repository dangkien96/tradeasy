<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessImage extends Model
{
	protected $connection = 'mysql2';
    protected $table = "tbl_opportunities_photo";
}
