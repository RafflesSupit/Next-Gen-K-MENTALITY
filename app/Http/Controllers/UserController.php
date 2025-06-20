<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $currentUser = Auth::user();
        return view('admin.users',compact('users','currentUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.editUsers', compact('users','currentUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'role'=> 'required|in admin,customer',
        ]);

        $user = User::findOrFail($id);
        $currentUser = Auth::user();
        if($user->id == 1 && $user->role == 'admin' && $currentUser->id != 1){
            return redirect()->route('admin.user.edit',$id)->with('error','Anda tidak memiliki izin untuk mengubah SUper Admin');
        }
            $user->role = $request->role;
            $user->save();
            return redirect()->route('admin.user.edit',$id)->with('success','Role Berhasil diperbaharui');
    }

    public function editProfile(){      
            $user = Auth::user();
            return view('profile.edit', compact('user')); 
    }

    public function updateProfile(Request $request){
        $User = Auth::user();
    $request->validate([
        'name'=> 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'password' => 'nullable|min:6|confirmed',
    ]);

    $user->name =$request->name;
    $email->email = $request->email;
    if($request->field('password')){
        $user->password = Hash::make($request->password);
    }
    $user-> save();
    return redirect()->route('profile.edit')->with('success','Profile berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','data berhasil dihapus');
    }
}
