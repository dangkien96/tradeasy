<?php 

namespace App\Libs\Providers;

use App\Models\Business;

class BuyProvider {

	private $business;

	public function __construct()
	{
		$this->business = new Business();
	}

	public function getBusiness($key) {
		$data = $this->business->where('key', $key)
								->first();

		return $data;
	}
}
