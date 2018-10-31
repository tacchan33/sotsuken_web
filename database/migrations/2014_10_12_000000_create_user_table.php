<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id')->comment('主キー');
            $table->string('email')->unique()->comment('メールアドレス兼ログインID');
            $table->string('password')->comment('ログインパスワード');
            $table->rememberToken()->comment('パスワードリセット用トークン');
            $table->timestamps();
            $table->string('lastname',16)->nullable()->comment('姓');
            $table->string('firstname',16)->nullable()->comment('名');
            $table->string('device_token')->nullable()->default('xxxxxxxxxxxxxxxxxxxxxxxxxxx')->comment('端末用トークン');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
