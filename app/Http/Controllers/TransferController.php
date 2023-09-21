<?php

namespace App\Http\Controllers;

use App\Team;
use App\Package;
use App\Category;
use App\Document;
use App\Logbook;
use App\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class TransferController extends Controller
{   
    public function __construct() {
        

        $this->middleware(function ($request, $next) {   
            // if(auth()->user()->hasRole('Teacher') && auth()->user()->category_id == null) {
            //     flash('Harap isi data jenis perlombaan tim anda terlebih dahulu')->error();
            //     return redirect()->route('setting.index');
            // }

            // if(auth()->user()->hasRole('Teacher') && auth()->user()->category_id != 3) {
            //     flash('Kategori Lomba anda tidak dapat mengakses menu Laporan Marketing.')->error();
            //     return redirect()->route('dashboard');
            // }
            
            // // if(auth()->user()->hasRole('Teacher') && Document::where('team_id', auth()->user()->id)->count() <= 0) {
            // //     flash('Harap isi Dokumen Tim Terlebih Dahulu.')->error();
            // //     return redirect()->route('documents.index');
            // // }
            
            //  if (auth()->user()->hasRole('Teacher') && auth()->user()->category_id != null) {
            //     $category = Category::where('id', auth()->user()->category_id)->first();

            //     if (Team::where('team_id', auth()->id())->count() != $category->number_of_user) {
            //         flash('Harap lengkapi jumlah team anda terlebih dahulu')->error();
            //         return redirect()->route('teams.index');
            //     } 
            // }
            
            if(auth()->user()->hasRole('Teacher') && Team::where('team_id', auth()->user()->id)->where('category_id', 3)->count() != 5)
            {
                flash('Harap lengkapi data peserta untuk kategori lomba Marketing Produk terlebih dahulu!')->warning();
                   $this->index();
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
        if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin')) {
            $data = Transfer::all();
        }
        else{
            $data = Transfer::where('team_id', auth()->id())->get();
        }
        
        return view('transfer.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('transfer.create');
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
        $input['team_id'] = auth()->id();
        
        if ($request->hasFile('image')) {
            $input['image'] = auth()->id().'-'.sha1(time()).'.'.request()->image->getClientOriginalExtension();
            request()->image->storeAs('public/uploads/tf/', $input['image']);
            //request()->image->move(public_path('uploads/images/'), $user->image);
        }

        Transfer::create($input);

        flash('Berhasil menambahkan bukti transfer')->success();

        return redirect()->route('transfers.index');
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
            $data = Transfer::find($id);

            return view('transfer.show', compact('data'));

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
        $data = Transfer::find($id);
        return view('transfer.edit', compact('data'));
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
            request()->image->storeAs('public/uploads/tf/', $input['image']);
            //request()->image->move(public_path('uploads/images/'), $user->image);
        }

        Transfer::find($id)->update($input);

        flash('Berhasil mengedit bukti transfer')->success();

        return redirect()->route('transfer.index');
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
            Transfer::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus bukti transfer'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus bukti transfer'
            ]);
        }
    }
}
