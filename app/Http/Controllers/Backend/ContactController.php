<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index() {
    	return view('Backend.Contents.contact.index');
    }

    public function list(Request $request, Contact $contactModel) {

    	$data = $contactModel->filterName($request->freetext)
    					->filterEmail($request->freetext)
    					->filterPhone($request->freetext)
    					->buildCond()
    					->orderBy('created_at', 'desc')
    					->paginate(10);

    	return response()->json($data);
    }
}
