<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDoctorsTable extends Migration
{
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id', 'department_fk_6449107')->references('id')->on('departments');
            $table->unsignedBigInteger('user_account_id')->nullable();
            $table->foreign('user_account_id', 'user_account_fk_6649069')->references('id')->on('users');
        });
    }
}
