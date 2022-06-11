<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacistSalariesTable extends Migration
{
    public function up()
    {
        Schema::create('pharmacist_salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('p_salary', 15, 2);
            $table->date('date');
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
