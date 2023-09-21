<?php

namespace App\Http\Controllers;

use App\Photoboot;
use App\Package;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class PhotobootController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('photoboot.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   ini_set('upload_max_filesize', '10M');
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
            $input['image'] = sha1(time()).'.'.request()->image->getClientOriginalExtension();
            request()->image->storeAs('public/uploads/photo/', $input['image']);
            //request()->image->move(public_path('uploads/images/'), $user->image);
        }

        Photoboot::create($input);

        flash('Berhasil Upload Foto Kontes')->success();

        return redirect()->route('photoboot.create');
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
