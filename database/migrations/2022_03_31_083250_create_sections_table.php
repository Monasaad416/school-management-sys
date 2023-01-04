<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration {

	public function up()
	{
		Schema::create('sections', function(Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->boolean('status');
			$table->bigInteger('grade_id')->unsigned();
			$table->bigInteger('level_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('sections');
	}
}
