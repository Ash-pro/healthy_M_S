<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSalariesTable extends Migration
{
    public function up()
    {
        Schema::table('salaries', function (Blueprint $table) {
            $table->unsignedBigInteger('d_name_id')->nullable();
            $table->foreign('d_name_id', 'd_name_fk_6449109')->references('id')->on('doctors');
        });
    }
}
