<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

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
        $valid_user = "admin@gmail.com";
        $valid_pass = "123";

        if ($request->username == $valid_user && $request->password == $valid_pass){
            session(['user' => $request->username]);
            return redirect()->route('home');
        } else {
            return back()->with('error', 'Username atau Password salah!');
        }
    }
    public function logout()
    {
        session()->forget('user');
        return redirect()->route('home');
    }
}