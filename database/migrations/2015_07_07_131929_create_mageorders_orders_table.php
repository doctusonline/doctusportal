<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMageordersOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mageorders_orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('order_id')->nullable();
			$table->unsignedInteger('mageorder_id');
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
		Schema::drop('mageorders_orders');
	}

}
