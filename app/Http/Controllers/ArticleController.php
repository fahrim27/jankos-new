<?php

namespace App\Http\Controllers;

use App\Article;
use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Article::all();
        return view('article.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
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
        $input['user_id'] = auth()->id();
        
        if ($request->hasFile('thumbnail')) {
            $input['thumbnail'] = time().'.'.request()->thumbnail->getClientOriginalExtension();
            
            request()->thumbnail->move(public_path('uploads/images/'), $input['thumbnail']);
        }

        $input['slug'] = Str::slug($input['title'], '-');

        
        Article::create($input);

        flash('Berhasil menambahkan artikel')->success();

        return redirect()->route('articles.index');
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
            $data = Package::find($id);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus paket layanan',
                'data' => $data
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus paket layanan'
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
        $data = Article::find($id);
        return view('article.edit', compact('data'));
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

        if ($request->hasFile('thumbnail')) {
            $input['thumbnail'] = time().'.'.request()->thumbnail->getClientOriginalExtension();
            
            request()->thumbnail->move(public_path('uploads/images/'), $input['thumbnail']);
        }

        $input['slug'] = Str::slug($input['title'], '-');

        
        Article::find($id)->update($input);

        flash('Berhasil mengedit artikel')->success();

        return redirect()->route('articles.index');
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
            Article::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus artikel'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus artikel'
            ]);
        }
    }
}
