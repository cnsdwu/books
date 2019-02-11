<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     *渲染注册页面
     */
    public function register(){
    	$admin = \Illuminate\Support\Facades\DB::table('admins')->select('title','icon','logo','theme')->where('id', 1)->first();
    	return view('register', compact('admin'));
    }
    /**
     * 添加用户
     */
    public function adduser(Request $request){
    	$request->validate([
    		'username' => 'required|max:100|alpha_dash|unique:users,username',
        	'email' => 'required|email|unique:users,email',
        	// 'password' => 'required|max:100|regex:['.*']',
        	'password' => [
        		'required',
        		'max:100',
        		'regex:/^[^\x7f-\xff]+$/'
        	],
    	],[
    		'username.required' => '用户名不能为空!',
    		'username.max' => '用户名太长!',
    		'username.alpha_dash' => '用户名只能为字母、数字、下划线、横线!',
    		'username.unique' => '用户名已存在!',
    		'email.required' => '邮箱不能为空!',
    		'email.email' => '邮箱格式不正确!',
    		'email.unique' => '该邮箱已被注册!',
    		'password.required' => '密码不能为空!',
    		'password.regex' => '密码不能包含中文!',
    		'password.max' => '密码太长!',
    	]);

    	$user = new User;
    	$user->username = $request->input('username');
    	$user->email = $request->input('email');
    	$user->password = Hash::make($request->input('password'));
    	$user->save();
        $user->userinfo()->create([
            'birth_year' => date('Y'),
            'nickname' => '用户'.$user->id,
        ]);
        $arrpath = scandir('images/head');
        $rand = rand(2,count($arrpath)-1);
        $user->headimage()->create([
            'path' => 'images/head/'.$arrpath[$rand]
        ]);
    	return redirect('/login')->withInput()->with(['error'=>1, 'message'=>'注册成功,请在此登录!']);
    }
}
