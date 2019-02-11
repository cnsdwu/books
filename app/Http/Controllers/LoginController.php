<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * 渲染登录页
     */
    public function index(){
        $admin = \Illuminate\Support\Facades\DB::table('admins')->select('title','icon','logo','theme')->where('id', 1)->first();
    	return view('login', compact('admin'));
    }
    /**
     * 登录
     */
    public function login(Request $request){
        $request->validate([
            'username' => 'required|max:100',
            'password' => 'required|max:100',
        ],[
            'username.required' => '用户名不能为空!',
            'username.max' => '用户名过长!',
            'password.required' => '密码不能为空!',
            'password.max' => '密码过长!',
        ]);
        $remeber = (bool)$request->input('autolog');
    	if(Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')], $remeber)) {
            // 认证通过...
            return redirect()->intended('/');
        }elseif(Auth::attempt(['email' => $request->input('username'), 'password' => $request->input('password')], $remeber)){
            return redirect()->intended('/');
        }else{
        	return back()->withInput()->with(['error'=>2, 'message'=>'登录名或密码错误!']);
        }

    }
    /**
     * 退出登录
     */
    public function logout(){
        if(Auth::check()){
            Auth::logout();
        }
        return redirect('/');
    }
}
