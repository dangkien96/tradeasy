<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Storage, Hash, Auth;
use App\User;

class UserController extends Controller
{
    private $userModel;
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;

        $this->middleware('permission:user.read', ['only' => ['list']]);
        $this->middleware('permission:user.read', ['only' => ['index']]);
        $this->middleware('permission:user.create',['only' => ['create']]);
        $this->middleware('permission:user.create', ['only' => ['store']]);
        $this->middleware('permission:user.read', ['only' => ['show']]);
        $this->middleware('permission:user.update', ['only' => ['edit']]);
        $this->middleware('permission:user.update', ['only' => ['update']]);
        $this->middleware('permission:user.delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Contents.user.index');
    }


    public function getList() {
        $users = $this->userModel::select('*')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Contents.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->_validateInsert($request);
        DB::beginTransaction();
        if ($request->hasFile('avatar')) {
            $path = $request->avatar->hashName('');
            $request->avatar->move('images/avatars', $path);
        } else {
            $path = '1.png';
        }
        try {
            $this->userModel->name     = $request->name;
            $this->userModel->email    = $request->email;
            $this->userModel->phone    = $request->phone;
            $this->userModel->avatar   = 'images/avatars/'.$path;
            $this->userModel->password = Hash::make('123456');
            $this->userModel->status   = $request->status;
            $this->userModel->save();
            DB::commit();
            return redirect()->route('users.index')->with('users', 'success');
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
        if (Auth::check()) {
            $user = $this->userModel::find(Auth::id());
            if (!empty($user)) {
                return view('Backend.Contents.user.updateSeft', ['user'=>$user]);
            }
        } else {
            return redirect()->route('login');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userModel::find($id);
            if (empty($user)) {
                // return view('Backend.Errors.page_404');
            } else {
                return view('Backend.Contents.user.update', ['user'=>$user]);
            }
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
        $this->_validateUpdate($request);

        $user = $this->userModel::find($id);
        DB::beginTransaction();
        if ($request->hasFile('avatar')) {
            $path = $request->avatar->hashName('');
            $request->avatar->move('images/avatars/', $path);
            $path = 'images/avatars/'.$path;
        } else {
            $path = $user->avatar;
        }
        try {
            $user->name     = $request->name;
            $user->phone    = $request->phone;
            if ( $request->status == 'DISABLE') {
                if (Auth::id() == $id || (!Auth::user()->hasRole(config('roleper.superadmin')) &&  $user->hasRole(config('roleper.superadmin'))) ) {
                    return redirect()->back()->withInput()->withErrors(['status' => 'Update status failue']);
                } else {
                    $user->status = $request->status;
                }
                
            } else {
                $user->status = $request->status;
            }
            $user->avatar   = $path;
            $user->save();
            DB::commit();
            return redirect()->route('users.index')->with('users', 'success');
        } catch (Exception $e) {
            DB::rollback();
            return view('Backend.Contents.user.update');
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
        if (isset($id) && Auth::check() && $id != Auth::user()->id) {
            $user = $this->userModel::findOrFail($id);
            if (empty($user) || $user->hasRole(config('roleper.superadmin')) ) {
                return response()->json(['status' => false], 422);
            } else {
                DB::beginTransaction();
                try {
                    DB::commit();
                    return response()->json(['status' => true], 200);
                } catch (Exception $e) {
                    DB::rollback();
                    return response()->json(['status' => false], 422);
                }
            }
        } else {
               return response()->json(['status' => false], 422);
           }
    }

    public function updateSeft(Request $request) {  
        if (Auth::check()) {
            $user = $this->userModel::find(Auth::id());
            if (!empty($user)) {
                $this->_validateUpdate($request);
                DB::beginTransaction();
                if ($request->hasFile('avatar')) {
                    $path = $request->avatar->hashName('');
                    $request->avatar->move('images/avatars/', $path);
                    $path = 'images/avatars/'.$path;
                } else {
                    $path = $user->avatar;
                }
                try {
                    $user->name     = $request->name;
                    // $user->status   = $request->status;
                    $user->avatar   = $path;
                    $user->phone    = $request->phone;
                    $user->save();
                    DB::commit();
                    return redirect()->back()->with('user', 'success');
                } catch (Exception $e) {
                    DB::rollback();
                    return view('Backend.Contents.aboutTeam.add');
                }
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function change() {
        if (Auth::check()) {
            return view('Backend.Contents.user.changPass');
        } else {
            return redirect()->route('login');
        }
    }

    public function changePassword(Request $request) {
        if (Auth::check()) {
            $this->_validateChangePass($request);
            $user = $this->userModel::find(Auth::id());
            if (!empty($user)) {
                DB::beginTransaction();
                try {
                    $user->password = Hash::make($request->password);
                    $user->save();
                    DB::commit();
                    return redirect()->back()->with('users', 'success');
                } catch (Exception $e) {
                    DB::rollback();
                    return redirect()->back();
                }
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function _validateInsert($request){
        $attribute = array(
            'name'  => trans('backend.user.name'),
            'email' => trans('backend.user.email'),
            'phone' => trans('backend.user.phone')
        );
        $rules  = array(
            'name'    => 'required|max:255',
            'email'   => 'required|max:255|email',
            'phone'   => 'required|max:15',
        );
        $messages = array();
        return $this->validate($request, $rules, $messages, $attribute);
    }

    public function _validateUpdate($request){
        $attribute = array(
            'name'  => trans('backend.user.name'),
            'phone' => trans('backend.user.phone')
        );
        $rules  = array(
            'name'    => 'required|max:255',
            'phone'   => 'required|max:15',
        );
        $messages = array();
        return $this->validate($request, $rules, $messages, $attribute);
    }

    

    public function _validateChangePass($request){
        return $this->validate($request, [
            'password' => 'required|max:32|min:8|same:confirm',
        ], [
        ]
       );
    }
}
