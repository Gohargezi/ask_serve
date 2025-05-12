<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if (!$request->has('email') || !$request->has('password'))
        {
            return view('login');
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || $user->password != $request->password) 
        {
            return redirect()->route('login')->with('error' , 'ایمیل یا رمز عبور اشتباه است');
        }
        session(['UserID' => $user->id]);
        if($user->role == 'admin')
        {
            return redirect()->route('admin/dashboard');
        }
        else
        {
            $previous = session('previous_url', route('search'));
            session()->forget('previous_url') ;
            return redirect($previous)->with('success' , 'ورود با موفقیت انجام شد') ;
        }
    }

    public function register(Request $request)
    {
        if (!$request->has('email') || !$request->has('password'))
        {
            return view('register');
        }
        if (User::where('email', $request->email)->exists())
        {
            return redirect()->route('login')->with('error' , 'ایمیل قبلا ثبت شده است');
        }
        else 
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = 'user';
            $user->save();
            return redirect()->route('login')->with('success' , 'ثبت نام با موفقیت انجام شد');      
        }

    }

    public function logout()
    {
        session()->forget('UserID');
        return redirect()->route('main')->with('success' , 'خروج با موفقیت انجام شد');
    }

    public function passwordRecovery(Request $request)
    {
        if (!$request->has('email') || !$request->has('name') || !$request->has('password'))
        {
            return view('password_recovery');
        }
        $user = User::where('email', $request->email)->where('name', $request->name)->first();
        if (!$user)
        {
            return redirect()->route('login')->with('error' , 'کاربری با این اطلاعات یافت نشد');
        }
        else
        {
            $user->password = $request->password;
            $user->save();
            return redirect()->route('login')->with('success' , 'رمز عبور با موفقیت تغییر کرد');
        }
    }

}
