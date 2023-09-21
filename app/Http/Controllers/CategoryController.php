<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();

        return view('kategori.index', compact('data'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['slug'] = Str::slug($request->nama);

        Category::create($input);

        flash('Berhasil menambah kategori lowongan')->success();
        return redirect()->route('kategori.index');
    }

    public function destroy($id)
    {
        try {
            $data = Category::find($id);

            $data->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus kategori lowongan'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus kategori lowongan'
            ]);
        }
    }
}
