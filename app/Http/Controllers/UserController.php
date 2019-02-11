<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function info(){
    	dd('22333233232');
    }
    /**
     * 个人设置渲染
     */
    public function set(){
    	if(!Auth::check()){
            return back();
        }
    	$admin = \Illuminate\Support\Facades\DB::table('admins')->select('title','icon','logo','theme','email')->where('id', 1)->first();
    	$user = [];
    	$user['path'] = Auth::user()->headimage()->value('path');
        $user['nickname'] = Auth::user()->userinfo()->value('nickname');
        $users = Auth::user();
        $userinfo = $users->userinfo()->first();
    	return view('user',compact('admin', 'user', 'userinfo', 'users'));
    }
    /**
     * 个人设置提交
     */
    public function update(Request $request){
    	if(!Auth::check()){
            return back()->withInput();
        }
        $request->validate([
    		// 'username' => 'required|max:100|alpha_dash|unique:users,username',
        	
        	
        	'sex' => 'required|boolean',
        	'constellation' => 'integer|min:0|max:12',
        	'password' => [
        		'required',
        		'max:100',
        		'regex:/^[^\x7f-\xff]+$/'
        	],
    	]);
    	$user = Auth::user();
    	if (!Hash::check($request->input('password'), $user->password)) {
    		return back()->with(['error'=>2, 'message'=>'密码不匹配!']);
    	}
    	if($user->email != $request->input('email')){
    		$request->validate([
    			'email' => 'required|email|unique:users,email',
    		]);
    	}
    	if($user->userinfo()->value('nickname') != $request->input('nickname')){
    		$request->validate([
    			'nickname' => 'required|unique:userinfos,nickname',
    		]);
    	}
    	$user->update([
    		'email' => $request->input('email'),
    	]);
    	$user->userinfo()->update([
    		'nickname' => $request->input('nickname'),
    		'sex' => $request->input('sex', 1),
    		'birth_year' => $request->input('birth_year', 1999),
    		'constellation' => $request->input('constellation', 0),
    		'address' => $request->input('address', ''),
    		'interest' => $request->input('interest', ''),
    	]);
    	return back()->with(['error'=>1, 'message'=>'数据已更新!']);
    }
    /**
     * kindle设置
     */
    public function kindle(Request $request){
        if(!Auth::check()){
            return back();
        }
        $request->validate([
            'kindleemail' => 'required|email',
        ]);
        if(!Hash::check($request->input('vcode', '123'), $request->input('hash', '1234'))){
            return back()->with([
                'error'=>2, 'message'=>'验证码不正确!',
                'kindleemail'=>$request->input('kindleemail'),
                'vcode'=>$request->input('hash')
            ]);
        }
        Auth::user()->userinfo()->update([
            'kindleemail' => $request->input('kindleemail', ''),
        ]);
        return back()->with(['error'=>1, 'message'=>'数据已更新!']);
    }
}
