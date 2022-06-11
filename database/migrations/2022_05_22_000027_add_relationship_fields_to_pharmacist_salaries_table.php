<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPharmacistSalariesTable extends Migration
{
    public function up()
    {
        Schema::table('pharmacist_salaries', function (Blueprint $table) {
            $table->unsignedBigInteger('p_name_id')->nullable();
            $table->foreign('p_name_id', 'p_name_fk_6649157')->references('id')->on('pharmacists');
        });
    }
}
