<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Validator;

class SliderController extends Controller
{
    public function index()
    {
        $data = Slider::all();

        return view('sliders.index', compact('data'));
    }

    public function create()
    {
        return view('sliders.create');
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,png',
        ]);

        if ($request->hasFile('image')) {
            $input['image'] = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->storeAs('public/uploads-1/uploads-2/uploads/slider/', $input['image']);
            //request()->image->move(public_path('uploads/images/'), $input['image']);
        }

        Slider::create($input);

        flash('Berhasil menambah gambar slider')->success();
        return redirect()->route('sliders.index');
    }

    public function destroy($id)
    {
        try {
            $slider = Slider::find($id);
            $image = $slider->image;
            // dd($slider);
            File::delete('public/uploads-1/uploads-2/uploads/slider/'.$image);

            $slider->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus slider'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus slider'
            ]);
        }
    }
}
