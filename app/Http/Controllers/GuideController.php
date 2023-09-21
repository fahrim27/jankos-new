<?php

namespace App\Http\Controllers;

use App\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Guide::all();
        
        return view('guide.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if (Guide::count() == 1) {
            flash('Hanya Dapat Menambahkan Satu Panduan')->warning();
            return redirect()->route('guides.index');
        }

        return view('guide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['for'] = 'Peserta';

        if ($request->hasFile('file')) {
            $input['file'] = time().'.'.request()->file->getClientOriginalExtension();
            
            request()->file->storeAs('public/uploads/', $input['file']);
        }
        
        Guide::create($input);

        flash('Berhasil menambahkan panduan')->success();

        return redirect()->route('guides.index');
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
        $data = Guide::find($id);
        return view('guide.edit', compact('data'));
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
        $input = $request->all();
        $input['for'] = 'Peserta';

        if ($request->hasFile('file')) {
            $input['file'] = time().'.'.request()->file->getClientOriginalExtension();
            
            request()->file->storeAs('public/uploads/', $input['file']);
        }
        
        Guide::find($id)->update($input);

        flash('Berhasil mengedit Panduan')->success();

        return redirect()->route('guides.index');
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
            Guide::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus Panduan'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus Panduan'
            ]);
        }
    }
}
