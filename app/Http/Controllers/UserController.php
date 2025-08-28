<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // List all attachees
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('users.index', compact('users'));
    }

    // Show create form
    public function create()
    {
        return view('users.create');
    }

    // Store new attachee
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('users.index')->with('success', 'Attachee added.');
    }

    // Show edit form
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update attachee
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);
        if ($data['password']) {
            $user->password = Hash::make($data['password']);
        }
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();
        return redirect()->route('users.index')->with('success', 'Attachee updated.');
    }

    // Delete attachee
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Attachee deleted.');
    }
}
