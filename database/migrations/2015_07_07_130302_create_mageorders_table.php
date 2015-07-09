<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMageordersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mageorders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('orderid');
			$table->string('sku');
			$table->string('product');			
			$table->string('name');		
			$table->string('street');
			$table->string('city');
			$table->string('country');
			$table->string('region');
			$table->string('postcode');
			$table->string('telephone');
			$table->string('email');
			$table->string('price');
			$table->string('status');

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
		Schema::drop('mageorders');
	}

}
