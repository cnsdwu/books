<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    /**
     * 首页
     */
    public function index(Request $request){
        $admin = \Illuminate\Support\Facades\DB::table('admins')->select('title','icon','logo','theme')->where('id', 1)->first();

        $category = array();
        $comment = array();
        $date = array();
        $auth = array();
        $post = new Post;
        $user = [];
        $order = 'admire';
        if ($request->route()->named('new')) {
                $order = 'id';
        }elseif($request->route()->named('click')){
                $order = 'look';
        }
        if(Auth::check()){
            $user['path'] = Auth::user()->headimage()->value('path');
            $user['nickname'] = Auth::user()->userinfo()->value('nickname');
        }
        $post = $post->select('id','title','logo','display','look','admire','created_at','author')->where('display',1)->orderBy($order,'desc')->paginate(45);
        foreach ($post as $key => $value) {
            if($temp = $value->category()->value('title')){
                $category[$value->id] = $temp;
            }else{
                $category[$value->id] = '未分类';
            }

            $time = new Mygettime(time(),date_timestamp_get($value->created_at));
            $date[$value->id] = $time->index();
            $auth[$value->id] = Post::find($value->id)->user()->value('username');
            // dd(Post::find()->get());
            $comment[$value->id] = $value->comment()->count();
        }
        // dd($comment);
        // dd($data);
        return view('index',compact('post','category','comment', 'auth', 'admin','date', 'user'));
    }
    public function regist(Request $request){
        
    }
    
}

class Mygettime{ 
        function  __construct($createtime,$gettime) { 
            $this->createtime = $createtime; 
            $this->gettime = $gettime; 
    } 
    function getSeconds() 
    { 
            return $this->createtime-$this->gettime; 
        } 
    function getMinutes() 
       { 
       return ($this->createtime-$this->gettime)/(60); 
       } 
      function getHours() 
       { 
       return ($this->createtime-$this->gettime)/(60*60); 
       } 
      function getDay() 
       { 
        return ($this->createtime-$this->gettime)/(60*60*24); 
       } 
      function getMonth() 
       { 
        return ($this->createtime-$this->gettime)/(60*60*24*30); 
       } 
       function getYear() 
       { 
        return ($this->createtime-$this->gettime)/(60*60*24*30*12); 
       } 
       function index() 
       { 
            if($this->getYear() > 1) 
            { 
                 // if($this->getYear() > 2) 
                 //    { 
                 //        return date("Y-m-d",$this->gettime); 
                 //        exit(); 
                 //    } 
                return intval($this->getYear())."年前"; 
                exit(); 
            } 
             if($this->getMonth() > 1) 
            { 
                return intval($this->getMonth())."月前"; 
                exit(); 
            } 
             if($this->getDay() > 1) 
            { 
                return intval($this->getDay())."天前"; 
                exit(); 
            } 
             if($this->getHours() > 1) 
            { 
                return intval($this->getHours())."小时前"; 
                exit(); 
            } 
             if($this->getMinutes() > 1) 
            { 
                return intval($this->getMinutes())."分钟前"; 
                exit(); 
            } 
           if($this->getSeconds() > 1) 
            { 
                return intval($this->getSeconds()-1)."秒前"; 
                exit(); 
            }
            return '刚刚';
            exit();
       } 
    } 
