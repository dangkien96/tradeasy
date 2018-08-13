<?php 

namespace App\Libs\Providers;
use DB;
use App\Models\Slide;
use App\Models\BusinessDB2;
use App\Models\Setting;
use App\Models\Recurits;


class HomeProvider {

	private $business;
	private $slideModel;
	private $settingModel;

	public function __construct()
	{
		$this->business     = new BusinessDB2();
		$this->slideModel   = new Slide();
		$this->settingModel = new Setting();
		$this->recuritModel = new Recurits();
	}

	public function getListBusiness () {
		$data = $this->business
					 ->where([
					 	['active', 1],
						['deleted', 0],
						['ranking', '!=', 9],
						['b_item', 1]
					 ])->locations()
					 ->paginate(12);

		return $data;
	}

	public function getBusinessNew () {
		$data = $this->business->select('id', 'code', 'intro_2', 'reference_profits', 'investment', 'Premise_Size', 'location_id', 'hot_item')
								->with(['locations' => function($query) {
									    $query->select('id', 'name_2');
								}])
								->where([
								['active', 1],
								['deleted', 0],
								['ranking', '!=', 9],
								['hot_item', 1],
								])->whereOr([
								['active', 1],
								['deleted', 0],
								['ranking', '!=', 9],
								['new_item', 1]
								])->whereOr([
								['active', 1],
								['deleted', 0],
								['ranking', '!=', 9],
								['b_item', 1]
								])
								->orderBy('sort_no', 'desc')
								->limit(9)
								->get();

		return $data;
	}

	public function getBusinessHot () {
		$data = DB::connection('mysql2')->table('tbl_opportunities')
								->select('tbl_opportunities_4.photo_1', 'tbl_opportunities.id', 'tbl_opportunities.intro_2',
								'investment', 'reference_profits')
								->where([
								['tbl_opportunities.active', 1],
								['tbl_opportunities.deleted', 0],
								['tbl_opportunities.ranking', '!=', 9],
								['tbl_opportunities.b_item', 1]
								])
								->join('tbl_opportunities_4', 'tbl_opportunities_4.cat_id', '=', 'tbl_opportunities.id')
								->inRandomOrder()
								->limit(9)
								->get();
		return $data;
	}
	

	public function getSlide() {
		$data = $this->slideModel->where([
					 	['status', "AVAILABLE"],])
						->get();
					 
		return $data;
	}

	public function getBannerHome() {
		$data = $this->settingModel->where('key', 'BANNER_HOME')
						->first();

		if (!empty($data->data)) {
			$data->data = json_decode($data->data);
	 	}

		return $data;
	}

	public function getRule () {
		$data = $this->settingModel->where('key', 'RULE_EVENT')
						->first();

		if (!empty($data->data)) {
			$data->data = json_decode($data->data);
	 	}

		return $data;
	}

	public function getRecruit () {
		$data = $this->recuritModel::orderBy('id', 'desc')->limit(5)->get();

		return $data;
	}

}
