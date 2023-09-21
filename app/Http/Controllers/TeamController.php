<?php

namespace App\Http\Controllers;

use App\Team;
use App\Package;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use Session;
use App\User;

class TeamController extends Controller
{   
    public function __construct() {
        // $this->middleware(function ($request, $next) {   
        //     if(auth()->user()->hasRole('Teacher') && auth()->user()->category_id == null) {
        //         flash('Harap isi data jenis perlombaan tim anda terlebih dahulu')->error();
        //         return redirect()->route('setting.index');
        //     }

        //     return $next($request);
        // });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin')) {
            $data = Team::all();
        }
        else{
            $data = Team::where('team_id', auth()->id())->get();
        }

        return view('team.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        Session::put('category', $id);
        $category = Category::where('id', $id)->first();
        
        return view('team.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if(Team::where('team_id', auth()->user()->id)->count() == 5)
        {
            flash('Tim anda telah lengkap!')->info();
            return redirect()->route('teams.index');
        }
        
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');
        
        if(Session::has('category')){
			$category = Session::get('category');
		}else{
			$category = null;
		}
		
        $rules = array(
            'image' => 'mimes:jpeg,png,jpg',
        );

        $messages = array(
                'image.mimes' => 'Maaf, ekstensi file tidak valid.',
            );

        $error = Validator::make($request->all(), $rules, $messages);
        
        if($error->fails())
        {
            return redirect()->back()->with(['errors' => $error->errors()->all()]);
        }

        $input = $request->except('image');
        $input['team_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $input['image'] = auth()->id().'-'.sha1(time()).'.'.request()->image->getClientOriginalExtension();
            request()->image->storeAs('public/uploads/profile/', $input['image']);
            //request()->image->move(public_path('uploads/images/'), $user->image);
        }

        $randompass = Str::random(8);

        $users['password'] = \Hash::make($randompass);
        $users['email']    = $input['username'];
        $users['password_default'] = $randompass;
        $users['email_verified_at'] = date("Y-m-d h:i:s");

        $role = 4;

        $user = User::create($users);
        $user->assignRole($role);

        $input['user_id'] = $user->id;
        Team::create($input);

        flash('Berhasil menambahkan team')->success();

        return redirect()->route('teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = Team::find($id);
    
            return view('team.show', compact('data'));
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
            ]);
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
        $data = Team::find($id);
        return view('team.edit', compact('data'));
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
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');
        
        $rules = array(
            'image' => 'mimes:jpeg,png,jpg',
        );

        $messages = array(
                'image.mimes' => 'Maaf, ekstensi file tidak valid.',
            );

        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails())
        {
            return redirect()->back()->with(['errors' => $error->errors()->all()]);
        }

        $input = $request->except('image');
        
        if ($request->hasFile('image')) {
            $input['image'] = auth()->id().'-'.sha1(time()).'.'.request()->image->getClientOriginalExtension();
            request()->image->storeAs('public/uploads/profile/', $input['image']);
            //request()->image->move(public_path('uploads/images/'), $user->image);
        }
        
        Team::find($id)->update($input);

        flash('Berhasil mengedit Team')->success();

        return redirect()->route('teams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $team = Team::findOrFail($id);

            if (!empty($team)) {
                User::where('id', $team->user_id)->delete();
            }
            $team->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus team'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus team'
            ]);
        }
    }
}
