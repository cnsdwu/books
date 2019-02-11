<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->string('title', 100)->default('');
            $table->text('content')->nullable(true);
            $table->string('logo', 255)->default('');
            $table->string('author', 100)->default('');
            $table->unsignedSmallInteger('display')->default(0);
            $table->unsignedInteger('look')->comment('点击量')->default(0);
            $table->unsignedInteger('admire')->comment('赞赏量')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
