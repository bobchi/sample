<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class SessionController extends Controller
{
    //
    public function create(){
        return view('sessions.create');
    }
    public function store(Request $request){
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        if(Auth::attempt($credentials, $request->has('remember'))){
            session()->flash('success','欢迎回来！');
            return redirect()->route('users.show',[Auth::user()]);
        }else{
            session()->fash('danger','抱歉，邮箱或密码错误！');
            return redirect()->back();
        }

    }
    public function destroy(){
        Auth::logout();
        session()->flash('success','你已退出！');
        return redirect('login');
    }
}
