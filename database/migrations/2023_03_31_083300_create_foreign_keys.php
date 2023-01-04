<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration {

	public function up()
	{

		Schema::table('levels', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grades')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grades')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		// Schema::table('myparents', function(Blueprint $table) {
		// 	$table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade')->onUpdate('cascade');
		// });

		Schema::table('myparents', function(Blueprint $table) {
			$table->foreign('father_nationality_id')->references('id')->on('nationalities')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('father_blood_type_id')->references('id')->on('bloods')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('father_religion_id')->references('id')->on('religions')->onDelete('cascade')->onUpdate('cascade');
		});


		Schema::table('parent_attachments', function(Blueprint $table) {
			$table->foreign('myparent_id')->references('id')->on('myparents')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('levels', function(Blueprint $table) {
			$table->dropForeign('levels_grade_id_foreign');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->dropForeign('sections_grade_id_foreign');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->dropForeign('sections_level_id_foreign');
		});
	}
}
