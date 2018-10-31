<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScanlogTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scanlog', function (Blueprint $table) {
			$table->bigIncrements('id')->comment('ID');
			$table->timestamps();
			$table->char('accesspoint_id',17)->nullable()->default(null)->comment('BSSID');
			$table->smallInteger('received_power')->nullable()->default(null)->comment('dBm');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('scanlog');
	}
}
