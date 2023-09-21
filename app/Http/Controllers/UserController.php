<?php

namespace App\Http\Controllers;

use App\User;
use App\Document;
use App\Team;
use App\Transfer;
use App\Member;
use App\Logbook;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::orderBy('created_at', 'desc')->get();

        return view('users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::where('name', '!=', 'Super Admin')->pluck('name', 'name');
        return view('users.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token']);
        $input['password'] = \Hash::make($input['password']);
        $input['email_verified_at'] = date("Y-m-d h:i:s");

        $role = $request->role_id;

        $user = User::create($input);
        $user->assignRole($role);

        flash('Berhasil menambahkan user')->success();

        return redirect()->route('users.index', ['type' => $role]);

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
        $data = User::find($id);
        $role = Role::where('name', '!=', 'Super Admin')->pluck('name', 'name');
        return view('users.edit', compact('data', 'role'));
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
        $input = $request->except(['_token', 'password']);

        $user = User::find($id);

        if($request->input('password'))
            $user->password = \Hash::make($request->password);

        $user->save();

        $user->update($input);

        flash('Berhasil mengubah user')->success();

        return redirect()->route('users.index');
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
            $user = User::where('id', $id)->first();
            
            if($user->status == 1){
                Team::where('team_id', $id)->delete();
                Document::where('team_id', $id)->delete();
                Logbook::where('team_id', $id)->delete();
                Member::where('team_id', $id)->delete();
                Transfer::where('team_id', $id)->delete();
            }
            
            $user->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus user'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus user'
            ]);
        }
    }
}
