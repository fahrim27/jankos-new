<?php

namespace App\Http\Controllers;

use App\Team;
use App\Package;
use App\Category;
use App\Document;
use App\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class LogbookController extends Controller
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
            $data = Logbook::all();
        }
        else{
            $data = Logbook::where('team_id', auth()->id())->get();
        }
        
        return view('logbook.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //return view('logbook.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // ini_set('upload_max_filesize', '10M');
        // ini_set('post_max_size', '10M');
        
        // $rules = array(
        //     'image' => 'mimes:jpeg,png,jpg',
        // );

        // $messages = array(
        //         'image.mimes' => 'Maaf, ekstensi file tidak valid.',
        //     );

        // $error = Validator::make($request->all(), $rules, $messages);

        // if($error->fails())
        // {
        //     return redirect()->back()->with(['errors' => $error->errors()->all()]);
        // }

        // $input = $request->except('image');
        // $input['team_id'] = auth()->id();
        
        // if ($request->hasFile('image')) {
        //     $input['image'] = auth()->id().'-'.sha1(time()).'.'.request()->image->getClientOriginalExtension();
        //     request()->image->storeAs('public/uploads/logbook/', $input['image']);
        //     //request()->image->move(public_path('uploads/images/'), $user->image);
        // }

        // Logbook::create($input);

        // flash('Berhasil menambahkan logbook')->success();

        // return redirect()->route('logbooks.index');
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
            $data = Logbook::find($id);

            return view('logbook.show', compact('data'));

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
        // $data = Logbook::find($id);
        // return view('logbook.edit', compact('data'));
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
        // ini_set('upload_max_filesize', '10M');
        // ini_set('post_max_size', '10M');
        
        // $rules = array(
        //     'image' => 'mimes:jpeg,png,jpg',
        // );

        // $messages = array(
        //         'image.mimes' => 'Maaf, ekstensi file tidak valid.',
        //     );

        // $error = Validator::make($request->all(), $rules, $messages);

        // if($error->fails())
        // {
        //     return redirect()->back()->with(['errors' => $error->errors()->all()]);
        // }

        // $input = $request->except('image');
        
        // if ($request->hasFile('image')) {
        //     $input['image'] = auth()->id().'-'.sha1(time()).'.'.request()->image->getClientOriginalExtension();
        //     request()->image->storeAs('public/uploads/logbook/', $input['image']);
        //     //request()->image->move(public_path('uploads/images/'), $user->image);
        // }

        // Logbook::find($id)->update($input);

        // flash('Berhasil mengedit Logbook')->success();

        // return redirect()->route('logbooks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // try {
        //     Logbook::find($id)->delete();

        //     return response()->json([
        //         'status' => true,
        //         'message' => 'Berhasil menghapus Logbook'
        //     ]);
        // } catch(\Exception $e) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Gagal menghapus Logbook'
        //     ]);
        // }
    }
}
