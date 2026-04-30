<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){
        if (session()->has('user')) {
            return redirect()->route('home');
            }
            return view('login');
    }
    
    public function login(Request $request)
    {
        $email = "admin@gmail.com";
        $password = "123";

        if ($request->email == $email && $request->password == $password){
            session(['user' => $request->email]);
            return redirect()->route('products.index');
        } else {
            return back()->with('error', 'Email atau Password salah!');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}