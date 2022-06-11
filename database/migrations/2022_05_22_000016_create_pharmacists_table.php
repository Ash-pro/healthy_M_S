<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacistsTable extends Migration
{
    public function up()
    {
        Schema::create('pharmacists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('age');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
