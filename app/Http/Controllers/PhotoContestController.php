<?php

namespace App\Http\Controllers;

use App\Photoboot;
use App\Package;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class PhotoContestController extends Controller
{   
    public function __construct() {
        $this->middleware(function ($request, $next) {   
            if(auth()->user()->hasRole('Teacher')) {
                flash('Anda tidak memiliki kases pada menu ini')->error();
                return redirect()->route('dashboard');
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Photoboot::all();

        return view('photoboot.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

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
            $data = Photoboot::find($id);

            return view('photoboot.show', compact('data'));
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
        try {
            Photoboot::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus foto kontes'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus foto kontes'
            ]);
        }
    }
}
