<?php

namespace App\Http\Controllers;

use App\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Validator;

class SponsorController extends Controller
{
    public function index()
    {
        $data = Sponsor::all();

        return view('sponsor.index', compact('data'));
    }

    public function create()
    {
        return view('sponsor.create');
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
         $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('image')) {
            $input['image'] = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->storeAs('public/uploads-1/uploads-2/uploads/sponsor/', $input['image']);
            //request()->image->move(public_path('uploads/images/'), $input['image']);
        }

        Sponsor::create($input);

        flash('Berhasil menambah sponsor')->success();
        return redirect()->route('sponsor.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Sponsor::find($id);
        return view('sponsor.edit', compact('data'));
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
        $input = $request->except('_token');
        $data = Sponsor::find($id);
        
         $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('image')) {
            $input['image'] = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->storeAs('public/uploads-1/uploads-2/uploads/sponsor/', $input['image']);
            //request()->image->move(public_path('uploads/images/'), $input['image']);
        }
        else{
            $input['image'] = $data->image;
        }
        
        Sponsor::find($id)->update($input);

        flash('Berhasil mengedit Sponsor')->success();

        return redirect()->route('sponsor.index');
    }

    public function destroy($id)
    {
        try {
            $sponsor = Sponsor::find($id);
            $image = $sponsor->image;
            // dd($slider);
            File::delete('public/uploads-1/uploads-2/uploads/sponsor/'.$image);

            $sponsor->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus sponsor'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus sponsor'
            ]);
        }
    }
}
