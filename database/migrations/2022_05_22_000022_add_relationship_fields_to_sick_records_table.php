<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSickRecordsTable extends Migration
{
    public function up()
    {
        Schema::table('sick_records', function (Blueprint $table) {
            $table->unsignedBigInteger('p_name_id')->nullable();
            $table->foreign('p_name_id', 'p_name_fk_6449127')->references('id')->on('patients');
        });
    }
}
