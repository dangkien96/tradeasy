<?php 

namespace App\Libs\Providers;

use App\Models\Location;
use App\Models\BusinessNature;
use DB;

class LocationProvider {

	private $locationModel;
	private $nature;
	private $mysqli_connection;

	public function __construct()
	{
		$this->locationModel = new Location();
		$this->nature = new BusinessNature();
	}

	public function getLocaiton() {
		$data = $this->locationModel->select('name_2', 'big_area', 'id')
								->where([
									['active', '1'], 
									['deleted', '0']
								])
								->get();

		return $data;
	}

	public function getGroupLocaiton() {
		$data = $this->locationModel->select('big_area')
								->groupBy('big_area')
								->orderBy('sort_no', 'asc')
								->get();

		return $data;
	}

	public function getNatrue() {
		$data = $this->nature->select('name_2', 'id')
					 		 ->where([
					 		 		['active', '1'], 
									['deleted', '0']
								])->orderBy('sort_no', 'asc')
					 		 ->get();
	
		return $data;
	}
}
