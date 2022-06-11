<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLaboratorsTable extends Migration
{
    public function up()
    {
        Schema::table('laborators', function (Blueprint $table) {
            $table->unsignedBigInteger('user_account_id')->nullable();
            $table->foreign('user_account_id', 'user_account_fk_6649070')->references('id')->on('users');
        });
    }
}
