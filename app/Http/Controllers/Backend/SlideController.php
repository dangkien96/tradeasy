<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slide;
use DB;

class SlideController extends Controller
{
    private $slideModel;
    public function __construct(Slide $slide)
    {
        $this->slideModel = $slide;
        
        $this->middleware('permission:slide.read', ['only' => ['list']]);
        $this->middleware('permission:slide.read', ['only' => ['index']]);
        $this->middleware('permission:slide.create',['only' => ['create']]);
        $this->middleware('permission:slide.create', ['only' => ['store']]);
        $this->middleware('permission:slide.read', ['only' => ['show']]);
        $this->middleware('permission:slide.update', ['only' => ['edit']]);
        $this->middleware('permission:slide.update', ['only' => ['update']]);
        $this->middleware('permission:slide.delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Contents.slide.index');
    }

    public function list () {

        $data = $this->slideModel->paginate(20);
        
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort_by = $this->slideModel->select('sort_by')
                                    ->orderBy('sort_by', 'asc')
                                    ->get();

        return view('Backend.Contents.slide.add', array('sort_bys'=>$sort_by));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();
        $this->_validateInsert($request);
        DB::beginTransaction();
        try {

            $this->slideModel->title     = $request->title;
            $this->slideModel->url_link  = $request->url_link;
            $this->slideModel->url_image = $request->url_image;
            $this->slideModel->status    = $request->status;
            $this->slideModel->sort_by   = $request->sort_by;
            $this->_updateSortBy($this->slideModel, $request->sort_by, -1);

            $this->slideModel->save();
            DB::commit();
            return redirect()->route('slides.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide   = $this->slideModel::findOrFail($id);
        
        $sort_by = $this->slideModel->select('sort_by')
                                    ->orderBy('sort_by', 'asc')
                                    ->get();

        return view('Backend.Contents.slide.add', array('slide' => $slide, 'sort_bys'=>$sort_by));
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

        $request->flash();
        $this->_validateInsert($request);
        $slideModel = $this->slideModel::findOrFail($id);

        DB::beginTransaction();
        try {
            $this->_updateSortBy($this->slideModel, $request->sort_by, $slideModel->sort_by);

            $slideModel->title     = $request->title;
            $slideModel->url_link  = $request->url_link;
            $slideModel->url_image = $request->url_image;
            $slideModel->status    = $request->status;
            $slideModel->sort_by   = $request->sort_by;
            
            $slideModel->save();

            DB::commit();
            return redirect()->route('slides.index');
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
            
            $slideModel = $this->slideModel->findOrFail($id);

            $this->_updateSortBy($this->slideModel, 100000000, $slideModel->sort_by);

            $slideModel->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }


    public function _updateSortBy ($model, $sortByNew, $sortByOld) {
        $sortMax   = $model::max('sort_by');
        if ($sortMax + 1 != $sortByNew && $sortByOld != $sortByNew) {
            if ($sortByOld == -1) {
                //Insert sort by new
                $listSortUp = $model->select('id', 'sort_by')->where('sort_by', ">=" , (int) $sortByNew)->get();

                foreach ($listSortUp as $key => $sort) {
                    $dataSortUp          = $model->findOrFail($sort->id);
                    $sortOld             = $sort->sort_by;
                    $dataSortUp->sort_by = $sortOld + 1;
                    $dataSortUp->save();
                }
            } else {
                //Update sort by old
                if ($sortByNew > $sortByOld) {
                    // Ex: 1 -> 4 down 2 to 4 one time.
                    $listSortDown = $model->select('id', 'sort_by')->whereBetween('sort_by', [$sortByOld + 1, $sortByNew])->get();
                    foreach ($listSortDown as $key => $sort ) {
                        $dataSortUp          = $model->findOrFail($sort->id);
                        $sortOld             = $sort->sort_by;
                        $dataSortUp->sort_by = $sortOld - 1;
                        $dataSortUp->save();
                    }
                }
                else {
                    // Ex: 6 -> 3 up 5 to 3 on time
                    $listSortDown = $model->select('id', 'sort_by')->whereBetween('sort_by', [$sortByNew, $sortByOld - 1])->get();
                    foreach ($listSortDown as $key => $sort ) {
                        $dataSortUp          = $model->findOrFail($sort->id);
                        $sortOld             = $sort->sort_by;
                        $dataSortUp->sort_by = $sortOld + 1;
                        $dataSortUp->save();
                    }
                }
            }
            return $listSortDown;
        }         
    }

    public function _validateInsert($request) {
        $this->validate($request, [
            'title' => 'between: 1, 255',
        ]);
    }
}
