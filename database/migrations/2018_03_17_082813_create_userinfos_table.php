<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('nickname', 100)->nullable(false);
            $table->string('constellation', 25)->nullable(true)->default('')->comment('星座');
            $table->string('interest', 100)->nullable(true)->default('')->comment('兴趣爱好');
            $table->year('birth_year')->nullable(true)->comment('出生年份');
            $table->unsignedSmallInteger('sex')->default(1);
            $table->string('address', 100)->nullable(true)->default('');
            $table->string('kindleemail', 100)->nullable(true)->default('');
            $table->string('head', 255)->nullable(true)->default('')->comment('头像');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userinfos');
    }
}
