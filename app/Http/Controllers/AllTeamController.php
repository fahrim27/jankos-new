<?php

namespace App\Http\Controllers;

use App\Team;
use App\Package;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class AllTeamController extends Controller
{   
    public function __construct() {
        $this->middleware(function ($request, $next) {   
            if(auth()->user()->hasRole('Teacher')) {
                flash('Anda tidak memiliki akses ke menu ini')->error();
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
        $data = User::where('status', 1)->get();

        return view('allteam.index', compact('data'));
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
            $data = User::find($id);    

            return view('allteam.show', compact('data'));
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDocument($id)
    {
        try {
            $data = User::find($id);    

            return view('allteam.documents', compact('data'));
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMember($id)
    {
        try {
            $data = User::find($id);    

            return view('allteam.member', compact('data'));
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showLogbook($id)
    {
        try {
            $data = User::find($id);    

            return view('allteam.logbook', compact('data'));
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
            ]);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAdd($id)
    {
        try {
            $data = User::find($id);    

            return view('allteam.additional', compact('data'));
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
