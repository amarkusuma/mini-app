<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
      return view('auth.change-password');
    }

    public function passwordChange(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|same:confirm_password',
        ]);

        $username = $request->username;
        $user = User::where('username', $username)->first();

        if(!$user) {
            return redirect()->back()->with("error","user tidak ditemukan.");
        }
        if (!(Hash::check($request->get('current-password'), $user->password))) {
            return redirect()->back()->with("error","Katas sandi tidak cocok.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->with("error","Kata sandi tidak boleh sama.");
        }

        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password successfully changed!");
    }
}
