<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'display',
    ];
	/**
	 * 一对多：文章关联评论
	 */
    public function comment(){
    	return $this->hasMany('\App\Comment', 'post_id');
    }
    /**
     * 一对多：文章关联文件
     */
    public function file(){
        return $this->hasMany('\App\File', 'post_id');
    }
    /**
     * 一对多：文章关联图片
     */
    public function image() {
    	return $this->hasMany('\App\Image', 'post_id');
    }
    /**
     * 反向一对多：文章关联用户
     */
    public function user(){
    	return $this->belongsTo('App\User', 'user_id');
    }
    /**
     * 多对多：文章关联分类
     */
    public function category(){
    	return $this->belongsToMany('App\Category', 'post_category', 'post_id', 'category_id');
    }
    /**
     * 多对多：文章关联标签
     */
    public function tag(){
        return $this->belongsToMany('App\Tag', 'post_tag', 'post_id', 'tag_id');
    }
}
