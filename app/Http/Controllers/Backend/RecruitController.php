<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Recurits;

class RecruitController extends Controller
{

    private $recruitModel;

    public function __construct(Recurits $recurits)
    {
        $this->recruitModel = $recurits;
    }

    public function list() {

        $data = $this->recruitModel->paginate(10);

        return response()->json($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Contents.recruit.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Contents.recruit.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->_validate($request);
        $end_date     = $request->end_date ? \Carbon\Carbon::parse($request->end_date)->format('Y/m/d') : $request->end_date; 
        DB::beginTransaction();
        try {
           $this->recruitModel->title    = $request->title;
           $this->recruitModel->slug     = sanitizeTitle($request->title);
           $this->recruitModel->end_date = $end_date;
           $this->recruitModel->content  = $request->content;
           $this->recruitModel->save();
           DB::commit();
           return redirect()->route('recruits.index');
        } catch (Exception $e) {
           DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recurit = $this->recruitModel->findOrfail($id);

        return view('Backend.Contents.recruit.add',array('recruit' => $recurit));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->_validate($request);
        $recruitModel = $this->recruitModel->findOrfail($id);
        $end_date     = $request->end_date ? \Carbon\Carbon::parse($request->end_date)->format('Y/m/d') : $request->end_date; 
        DB::beginTransaction();
        try {
           $recruitModel->title    = $request->title;
           $recruitModel->slug     = sanitizeTitle($request->title);
           $recruitModel->end_date = $end_date;
           $recruitModel->content  = $request->content;
           $recruitModel->save();
           DB::commit();
           return redirect()->route('recruits.index');
        } catch (Exception $e) {
           DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $recruit = $this->recruitModel->findOrfail($id);
            $recruit->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }


    public function _validate ($request) {
        $this->validate($request, [
            'title' => 'required| max: 255',
        ], 
        []);
    }
}
