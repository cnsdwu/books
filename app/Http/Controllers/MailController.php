<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\OrderShipped;
use Mail;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Jobs\MailProcess;

class MailController extends Controller
{
    public function mail(Request $request, $path, $bookname, $extension){
    	// dd($path.$bookname);
        if(!Auth::check()){
            return back()->with(['error'=>2, 'message'=>'请在登录后进行操作!']);
        }
        $user = User::find(1)->where('id', Auth::id())->first();
        $email = $user->userinfo()->select('kindleemail')->first()->kindleemail;
        $admin = \Illuminate\Support\Facades\DB::table('admins')->where('id', 1)->value('email');
        // dd($email);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            \App\File::find(1)->where('path', 'like', '%'.$path)->increment('push');
	    	Mail::to($email)->send(new OrderShipped($admin, $bookname, $extension, storage_path().'/app/public/upload/book/'.$path));
	    	// MailProcess::dispatch($email, $bookname, $extension, $path);
	    	// MailProcess::dispatch('1','1','1','1');
	    	// dd($temp);
        	return back()->with(['error'=>1, 'message'=>'加入推送队列成功!']);
        }else{
        	return back()->with(['error'=>2, 'message'=>'邮箱格式不正确,请在个人页面进行设置!']);
        	
        }
    }
    /**
     * 推送测试邮件
     */
    public function test(Request $request, $email){
        $vcode = rand(1000,9999);
        if(!Auth::check()){
            return back()->with(['error'=>2, 'message'=>'请在登录后进行操作!','kindleemail'=>$email]);
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $admin = \Illuminate\Support\Facades\DB::table('admins')->where('id', 1)->value('email');
            Mail::to($email)->send(new OrderShipped($admin, '验证码：'.$vcode, 'txt', storage_path().'/app/public/upload/test.txt'));
            return back()->with([
                'error' => 1, 
                'message' => '加入推送队列成功!',
                'kindleemail' => $email, 
                'vcode' => \Illuminate\Support\Facades\Hash::make($vcode),
            ]);
        }else{
            return back()->with(['error'=>2, 'message'=>'邮箱格式不正确!','kindleemail'=>$email]);
            
        }
    }
}
