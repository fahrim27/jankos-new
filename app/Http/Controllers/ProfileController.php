<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Validator;
use Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function create()
    {
        $data = Profile::where('user_id', auth()->user()->id)->first();
        return view('setting.profilecreate', compact('data'));
    }

    public function store(Request $request)
    {   
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');
        
        $rules = array(
            'ijazahsd' => 'mimes:jpeg,png,pdf,jpg',
            'ijazahsmp' => 'mimes:jpeg,png,pdf,jpg',
            'ijazahsma' => 'mimes:jpeg,png,pdf,jpg',
            'ijazahs1' => 'mimes:jpeg,png,pdf,jpg',
            'ijazahs2' => 'mimes:jpeg,png,pdf,jpg',
            'ijazahs3' => 'mimes:jpeg,png,pdf,jpg',
            'bukti' => 'mimes:jpeg,png,pdf,jpg',
            'portofolio' => 'mimes:jpeg,png,pdf,jpg',
        );

        $messages = array(
                'ijazahsd.mimes' => 'Maaf, ekstensi file tidak valid.',
                'ijazahsmp.mimes' => 'Maaf, ekstensi file tidak valid.',
                'ijazahsma.mimes' => 'Maaf, ekstensi file tidak valid.',
                'ijazahs1.mimes' => 'Maaf, ekstensi file tidak valid.',
                'ijazahs2.mimes' => 'Maaf, ekstensi file tidak valid.',
                'ijazahs3.mimes' => 'Maaf, ekstensi file tidak valid.',
                'bukti.mimes' => 'Maaf, ekstensi file tidak valid.',
                'portofolio.mimes' => 'Maaf, ekstensi file tidak valid.',
            );

        $error = Validator::make($request->all(), $rules, $messages);

        if($error->fails())
        {
            return redirect()->back()->with(['errors' => $error->errors()->all()]);
        }

        $input = $request->except('_token');

        if ($request->hasFile('ijazahsd')) {
            $input['ijazahsd'] = Str::slug(auth()->user()->name).'-'.sha1(time()).'-ijazah sd' . '.' . request()->ijazahsd->getClientOriginalExtension();
            request()->ijazahsd->storeAs('public/uploads-1/uploads-2/uploads/', $input['ijazahsd']);
            //request()->ijazahsd->move(public_path('uploads/file/'), $input['ijazahsd']);
        }

        if ($request->hasFile('ijazahsmp')) {
            $input['ijazahsmp'] = Str::slug(auth()->user()->name).'-'.sha1(time()).'-ijazah smp' . '.' . request()->ijazahsmp->getClientOriginalExtension();
            request()->ijazahsmp->storeAs('public/uploads-1/uploads-2/uploads/', $input['ijazahsmp']);
            //request()->ijazahsmp->move(public_path('uploads/file/'), $input['ijazahsmp']);
        }

        if ($request->hasFile('ijazahsma')) {
            $input['ijazahsma'] = Str::slug(auth()->user()->name).'-'.sha1(time()).'-ijazah sma' . '.' . request()->ijazahsma->getClientOriginalExtension();
            request()->ijazahsma->storeAs('public/uploads-1/uploads-2/uploads/', $input['ijazahsma']);
            //request()->ijazahsma->move(public_path('uploads/file/'), $input['ijazahsma']);
        }

        if ($request->hasFile('ijazahs1')) {
            $input['ijazahs1'] = Str::slug(auth()->user()->name).'-'.sha1(time()).'-ijazah s1' . '.' . request()->ijazahs1->getClientOriginalExtension();
            request()->ijazahs1->storeAs('public/uploads-1/uploads-2/uploads/', $input['ijazahs1']);
            //request()->ijazahs1->move(public_path('uploads/file/'), $input['ijazahs1']);
        }

        if ($request->hasFile('ijazahs2')) {
            $input['ijazahs2'] = Str::slug(auth()->user()->name).'-'.sha1(time()).'-ijazah s2' . '.' . request()->ijazahs2->getClientOriginalExtension();
            request()->ijazahs2->storeAs('public/uploads-1/uploads-2/uploads/', $input['ijazahs2']);
            //request()->ijazahs2->move(public_path('uploads/file/'), $input['ijazahs2']);
        }

        if ($request->hasFile('ijazahs3')) {
            $input['ijazahs3'] = Str::slug(auth()->user()->name).'-'.sha1(time()).'-ijazah s3' . '.' . request()->ijazahs3->getClientOriginalExtension();
            request()->ijazahs3->storeAs('public/uploads-1/uploads-2/uploads/', $input['ijazahs3']);
            //request()->ijazahs3->move(public_path('uploads/file/'), $input['ijazahs3']);
        }
        
        if ($request->hasFile('bukti')) {
            $input['bukti'] = Str::slug(auth()->user()->name).'-'.sha1(time()).'-bukti' . '.' . request()->bukti->getClientOriginalExtension();
            request()->bukti->storeAs('public/uploads-1/uploads-2/uploads/', $input['bukti']);
        }

        if ($request->hasFile('portofolio')) {
            $input['portofolio'] = Str::slug(auth()->user()->name).'-'.sha1(time()).'-cv' . '.' . request()->portofolio->getClientOriginalExtension();
            request()->portofolio->storeAs('public/uploads-1/uploads-2/uploads/', $input['portofolio']);
        }

        $input['user_id'] = auth()->user()->id;

        $profile = Profile::where('user_id', auth()->id())->first();

        if ($profile) {
            $profile->update($input);
            flash('Berhasil mengedit data profile')->success();
        } else {
            flash('Berhasil menambah data profile')->success();
            Profile::create($input);
        }

        return redirect()->route('setting.index');
    }
}
