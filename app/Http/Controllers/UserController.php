<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $currentUser = Auth::user();
        return view('admin.users', compact('users','currentUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        return view('admin.editUsers', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,customer', // sesuaikan daftar role
        ]);

        $user = User::findOrFail($id); // user yang akan diubah
        $currentUser = Auth::user(); // user yang sedang login

        // Cegah jika user yang sedang login BUKAN super admin tapi mencoba ubah super admin
        if ($user->id == 1 && $user->role == 'admin' && $currentUser->id != 1) {
            return redirect()->route('admin.user.edit', $id)->with('error', 'You do not have permission to change Super Admin.');
        }

        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.user.edit', $id)->with('success', 'Role has been updated.');
    }

    public function editProfile()
{
    $user = Auth::user();
    return view('profile.edit', compact('user'));
}

    public function updateProfile(Request $request)
        {
            $user = Auth::user();

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|min:6|confirmed',
            ]);

            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
        }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User successfully deleted.');
    }

}
