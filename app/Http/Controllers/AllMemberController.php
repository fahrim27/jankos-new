<?php

namespace App\Http\Controllers;

use App\Team;
use App\Member;
use App\Logbook;
use App\Category;
use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class AllMemberController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allMeber()
    {   
        $data = Member::all();

        return view('member.all', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFromAll($id)
    {
        try {
            $data = Member::find($id);

            return view('member.show', compact('data'));

        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
