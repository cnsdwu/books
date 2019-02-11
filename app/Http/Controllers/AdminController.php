<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Post;

class AdminController extends Controller
{
    /**
     * 后台首页渲染
     */
    public function index(){
    	if(!Auth::check()){
    		return redirect('/login');
    	}
    	$admin = DB::table('admins')->where('id', 1)->first();
    	$theme = scandir('theme');
    	return view('admin.index',compact('admin','theme'));
    }
    /**
     * 进行基本设置
     */
    public function setbase(Request $request){
    	if(!Auth::check()){
    		return back()->with(['do'=>'admin', 'error'=>1, 'message'=>'请在登录后进行操作!']);
    	}
    	if(!Auth::attempt(['id' => Auth::id(), 'password' => $request->input('password')],true)) {
    		Auth::logout();
    		return redirect('/login');
    	}
    	$arr = [];
    	if($request->input('title')){
    		$arr['title'] = $request->input('title');
    	}
    	if($request->input('theme')){
    		$arr['theme'] = $request->input('theme');
    	}
    	if($request->hasFile('logo')){
    		// dd(222);
            if($request->file('logo')->isValid()){
                $arrtemp = array('png','jpg','gif','jpeg','bmp','tiff','pcx','tga','exif','fpx','svg','psd','cdr','pcd','dxf','ufo','eps','ai','raw','WMF','webp');
                if(in_array($request->file('logo')->extension(), $arrtemp)){
                    $arr['logo'] = 'storage/'.$request->file('logo')->store('upload/images','public');
                }
                // echo $coverPath;
            }

        }
        if($request->hasFile('icon')){
            if($request->file('icon')->isValid()){
                $arrtemp = array('png','jpg','gif','jpeg','bmp','tiff','pcx','tga','exif','fpx','svg','psd','cdr','pcd','dxf','ufo','eps','ai','raw','WMF','webp');
                if(in_array($request->file('icon')->extension(), $arrtemp)){
                    $arr['icon'] = 'storage/'.$request->file('icon')->store('upload/images','public');
                }
                // echo $coverPath;
            }

        }

    	if(DB::table('admins')->where('id', 1)->count() > 0){
    		DB::table('admins')->where('id', 1)->update($arr);
    		return back()->with(['do'=>'admin', 'error'=>0, 'message'=>'数据更新成功!']);
    	}else{
    		DB::table('admins')->insert([
    			'id' => 1,
                'title' => $request->input('title', 'kindle'),
    			'email' => $request->input('email', 'admin@wwzc.cc'),
    			'theme' => $request->input('title', 'kindle'),
    			'logo' => $request->input('logo', './image/logo.png'),
    			'icon' => $request->input('icon', './image/favicon.ico'),
    		]);
    	}
    }
    /**
     * 默认头像渲染
     */
    public function head(){
    	if(!Auth::check()){
    		return redirect('/login');
    	}
    	$admin = DB::table('admins')->where('id', 1)->first();
        return view('admin.head',compact('admin'));
    }
    /**
     * 图书列表渲染
     */
    public function booklist(){
        $post = new Post;
        $category = array();
        $admin = DB::table('admins')->where('id', 1)->first();
        $post = $post->select('id','title','display','created_at','author')->orderBy('id','desc')->paginate(30);
        foreach ($post as $key => $value) {
            if($temp = $value->category()->value('title')){
                $category[$value->id] = $temp;
            }else{
                $category[$value->id] = '未分类';
            }
        }
        return view('admin.booklist', compact('admin','post','category'));
    }
    /**
     * 图书审核
     */
    public function display($id){
        $post = new Post;
        $display = 1;
        if($post->where('id', $id)->value('display') > 0){
            $display = 0;
        }
        $post->where('id', $id)->update([
            'display' => $display,
        ]);
        return response()->json([
            'error'=>1, 'message'=>'成功!'
        ]);
    }
    /**
     * 图书删除
     */
    public function del($id){
        $post = Post::findOrFail($id);
        $post->delete();
        if($post->trashed()){
            return response()->json([
                'error'=>1, 'message'=>'成功!'
            ]);
        }else{
            return response()->json([
                'error'=>2, 'message'=>'失败!'
            ]);
        }
    }
}
