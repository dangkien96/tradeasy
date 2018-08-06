<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StartUpController extends Controller
{
    public function startup () {
    	return view('Frontend.Contents.start-up.index');
    }

    public function aboutUs() {
    	return view('Frontend.Contents.about.index');
    }
}
