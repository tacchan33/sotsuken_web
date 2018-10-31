<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesspointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesspoint', function (Blueprint $table) {
            $table->char('id',17)->primary()->comment('BSSID');
            $table->timestamps();
            $table->double('transmit_power')->nullable()->default(0)->comment('送信電力dBm');
            $table->string('essid',32)->nullable()->default('不明')->comment('ESSID');
            $table->string('building',20)->nullable()->default('不明')->comment('建物名');
            $table->tinyInteger('floor')->nullable()->default(0)->comment('階数');
            $table->string('room',20)->nullable()->default('不明')->comment('部屋名');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesspoint');
    }
}
