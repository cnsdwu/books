<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * 添加评论
     */
    public function add(Request $request, $id){
		if(!Auth::check()){
			return back();
		}
		$request->validate([
        'comment' => 'required',
    	],[
        'comment.required' => '评论内容不能为空!',
    	]);
		$comment = new Comment;
		$comment->create(['user_id'=>Auth::id(),'post_id'=>$id,'content'=>$request->input('comment','2323233232')]);
		return back();
    }
}
