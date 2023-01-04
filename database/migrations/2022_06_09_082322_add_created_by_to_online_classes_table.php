<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('online_classes', function (Blueprint $table) {
            $table->string('created_by');
        });
    }

    public function down()
    {
        Schema::table('online_classes', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });
    }
};
