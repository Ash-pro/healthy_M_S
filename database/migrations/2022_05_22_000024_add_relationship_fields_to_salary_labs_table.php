<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSalaryLabsTable extends Migration
{
    public function up()
    {
        Schema::table('salary_labs', function (Blueprint $table) {
            $table->unsignedBigInteger('laboratories_id')->nullable();
            $table->foreign('laboratories_id', 'laboratories_fk_6449151')->references('id')->on('laborators');
        });
    }
}
