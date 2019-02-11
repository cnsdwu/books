<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = ['user_id', 'post_id', 'content'];
    /**
     * 一对多：评论关联图片
     */
    public function image(){
    	return $this->belongsTo('App\Image', 'comment_id', 'id');
    }
}
