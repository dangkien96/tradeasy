<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Recurits;

class RecruitController extends Controller
{
    public function recruit (Recurits $recruit) {
    	$recruits = $recruit->get();

    	return view('Frontend.Contents.recruit.index', array('recruits' => $recruits) );
    }

    public function recruitDetail ($id, $slug, Request $request, Recurits $recruit) {

    	$recruitModel = $recruit::findOrFail($id); 
    	return view('Frontend.Contents.recruit.detail', array('recruit' => $recruitModel));
    }
}
