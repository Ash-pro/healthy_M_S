<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryLabsTable extends Migration
{
    public function up()
    {
        Schema::create('salary_labs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('salary', 15, 2);
            $table->date('date');
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
