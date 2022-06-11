<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSickRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('sick_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('reception_recording')->nullable();
            $table->longText('doctors_diagnosis')->nullable();
            $table->longText('laboratory_analysis')->nullable();
            $table->string('receiving_medicine')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
