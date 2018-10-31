<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWifibeaconTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wifibeacon', function (Blueprint $table) {
			$table->unsignedInteger('user_id')->nullable()->comment('ユーザID');
			$table->unsignedTinyInteger('sequence')->nullable()->default(1)->comment('順序番号');
			$table->datetime('updated_at')->nullable()->comment('最終更新日時');
			$table->char('accesspoint_id',17)->nullable()->comment('BSSID');
			$table->smallInteger('received_power')->nullable()->comment('dBm');

			$table->primary(['user_id','sequence']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('wifibeacon');
	}
}
