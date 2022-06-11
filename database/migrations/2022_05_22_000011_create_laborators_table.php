<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratorsTable extends Migration
{
    public function up()
    {
        Schema::create('laborators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('specialty');
            $table->string('address');
            $table->string('phone');
            $table->date('birthday');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
