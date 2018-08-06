<?php 

namespace App\Libs\Providers;

use App\Models\Setting;

class AboutUs {

	private $setting;

	public function __construct()
	{
		$this->setting = new Setting();
	}

	public function aboutUs () {
		$about = $this->setting->where('key', 'ABOUT_US')
								->first();
		if (!empty($about->data)) {
			$about->data = json_decode($about->data);
		}
		return $about;
	}

	public function getContact() {
		$contact = $this->setting->where('key', 'CONTACT')
								->first();
		if (!empty($contact->data)) {
			$contact->data = json_decode($contact->data);
		}
		return $contact;
	}
}
