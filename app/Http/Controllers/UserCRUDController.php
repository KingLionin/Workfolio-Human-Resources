<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class UserCRUDController extends Controller
{
    public function addUser(Request $request)
    {
        $request->validate([
            'last_name' => 'required|max:225',
            'first_name' => 'required|max:225',
            'middle_name' => 'required|max:225',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Check if the email already exists
        if ($this->emailExists($request->email)) {
            return redirect()->back()->with('error', 'Email already Exists!!!');
        }

        $data = $request->all();
        $user = $this->create($data);

        event(new Registered($user));

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();

        return redirect()->route('verification.notice');
    }

    public function create(array $data)
    {
        return User::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    private function emailExists($email)
    {
        return User::where('email', $email)->exists();
    }

    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'last_name' => 'required|max:225',
            'first_name' => 'required|max:225',
            'middle_name' => 'required|max:225',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = $request->all();

        // Update only if the password is provided
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // Remove the password field from the update if not provided
        }

        $user->update($data);

        return redirect("Mainpage/users")->with('success', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect("Mainpage/users")->with('success', 'User deleted successfully');
    }
}
