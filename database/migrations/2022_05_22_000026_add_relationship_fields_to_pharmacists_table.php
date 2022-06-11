<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPharmacistsTable extends Migration
{
    public function up()
    {
        Schema::table('pharmacists', function (Blueprint $table) {
            $table->unsignedBigInteger('user_account_id')->nullable();
            $table->foreign('user_account_id', 'user_account_fk_6649071')->references('id')->on('users');
        });
    }
}
