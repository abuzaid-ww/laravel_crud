<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $incomingValues = $request->validate([
            'loginName' => 'required',
            'loginPassword' => 'required'
        ]);

        if (auth()->attempt(['name' => $incomingValues['loginName'], 'password' => $incomingValues['loginPassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request)
    {
        $incomingValues = $request->validate([
            'name' => ['required', 'min:3', 'max:100', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6'],

        ]);

        $incomingValues['password'] = bcrypt($incomingValues['password']);

        $user = User::create($incomingValues);
        auth()->login($user);
        return redirect('/');
    }
}
