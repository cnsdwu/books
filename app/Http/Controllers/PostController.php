<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Post;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\DB;
// use App\User;

class PostController extends Controller
{
    /**
     * 图书详情
     */
    public function info(Request $request,$id){
    	$post = Post::findOrFail($id);
        $post = $post->select('title','id','user_id', 'content','created_at','look','admire','logo','display','author')->where('id',$id)->first();
        $category = $post->category()->select('title')->first();
        if($category == null){
            $category = (object)array('title'=>'未分类');
        }
        $file = $post->file()->select('path','push','download','extension','size')->get();
        $author = $post->user()->first()->userinfo()->first();
        $temp = $post->comment()->select('id', 'user_id', 'cid', 'content', 'created_at', 'admire')->get();
        $comment = [];
        if(count($temp) > 0){
            foreach ($temp as $key => $value) {
                // dd($value);
                $comment[$key]['nickname'] = DB::table('userinfos')->where('user_id',$value->user_id)->orderBy('id', 'desc')->value('nickname');
                $comment[$key]['time'] = (new Mygettime(time(),date_timestamp_get($value->created_at)))->index();
                $comment[$key]['content'] = $value->content;
                $comment[$key]['admire'] = $value->admire;
                $comment[$key]['id'] = $value->id;
                $comment[$key]['comment'] = $post->comment->where('cid', $value->id)->count();
                $comment[$key]['path'] = DB::table('headimages')->where('user_id', $value->user_id)->value('path');
            }
        }
        $user = [];
        if(Auth::check()){
            $user['path'] = Auth::user()->headimage()->value('path');
            $user['nickname'] = Auth::user()->userinfo()->select('nickname')->value('nickname');
        }
        $admin = \Illuminate\Support\Facades\DB::table('admins')->select('title','icon','logo','theme')->where('id', 1)->first();
        // dd($comment);
        // dd($comment);
        // dd($file[0]->path);
        // dd(storage::size('public/'.$file[0]->path));
        // dd($file);
        // dd($test);
        return view('info',compact('post','category','file','comment', 'user', 'admin', 'author'));
    }
    /**
     * 提交内容渲染
     */
    public function post(){
      if(!Auth::check()){
        return redirect()->intended('/');
      }
      $user = [];
      $user['path'] = Auth::user()->headimage()->value('path');
      $user['nickname'] = Auth::user()->userinfo()->value('nickname');
      $admin = \Illuminate\Support\Facades\DB::table('admins')->select('title','icon','logo','theme')->where('id', 1)->first();
    	// $category = Category::f;
    	$category = Category::select('title','id')->get();
    	// dd($category);
    	return view('post',compact('category', 'admin', 'user'));
    }
    /**
     * 发表内容
     */
    public function add(Request $request){
    	if(!Auth::check()){
        	return redirect()->intended('/');
      	}

      	$request->validate([
        'title' => 'required|max:100',
    		// 'content' => 'required',
        	'author' => 'required|max:100',
        	'category' => 'required|integer',
    	],[
        'title.required' => '书名不能为空!',
    		// 'content.required' => '书名不能为空!',
    		'title.max' => '书名太长!',
    		'author.required' => '作者不能为空!',
    		'author.max' => '作者名太长!',
    		'category.required' => '分类不能为空!',
    		'category.integer' => '分类格式不正确!',
    	]);

		$arrPath = array();
    if($tempBook = $request->input('book')){
      foreach ($tempBook as $key => $value) {
        $arrPath[$key]['path'] = 'upload/book/'.$value;
        $arrPath[$key]['type'] = 0;
        $arrPath[$key]['extension'] = explode('.', $value)[1];
        $arrPath[$key]['size'] = storage::size('/public/upload/book/'.$value);
      }
    }
		
		$tag = new Tag;
    	$post = new Post;
    	$post->user_id = Auth::id();
      $post->title = $request->input('title');
    	$post->author = $request->input('author');
    	$post->content = $request->input('bookInfo');
    	$post->logo = $request->input('cover', '');
    	$post->save();
    	$post->category()->attach($request->input('category'));
    	if($request->has(['tag'])){
    		foreach ($request->input('tag') as $key => $value) {
    			if($temp = $tag->where('title',$value)->first()){
    				$post->tag()->attach($temp->id);
    			}else{
    				$post->tag()->create(['title'=>$value]);
    			}
    		}
    	}
    	$post->file()->createMany($arrPath);

      return redirect('/post/'.$post->id)->with(['error'=>1, 'message'=>'提交成功,请等待管理员审核!']);
    	// return redirect('post/'.$post->id);
    	// dd($bookPath);

    }
    /**
     * 用户点赞
     */
    public function admire(Request $request, $type, $id){
        // dd($type);
    	if(Auth::check()){
            if($type == 'post'){
                if(DB::table('post_admire')->where('type',0)->where('user_id',Auth::id())->where('post_id',$id)->count() == 0){
                    DB::table('post_admire')->insert(['post_id'=>$id,'user_id'=>Auth::id(), 'type'=>0, 'created_at'=>date('Y-m-d H:i:s')]);
                    (new Post)->where('id',$id)->increment('admire');
                }
            }elseif ($type == 'comment') {
                if(DB::table('post_admire')->where('type',1)->where('user_id',Auth::id())->where('post_id',$id)->count() == 0){
                    DB::table('post_admire')->insert(['post_id'=>$id,'user_id'=>Auth::id(), 'type'=>1, 'created_at'=>date('Y-m-d H:i:s')]);
                    DB::table('comments')->where('id',$id)->increment('admire');
                }
            }
        	
      	}
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