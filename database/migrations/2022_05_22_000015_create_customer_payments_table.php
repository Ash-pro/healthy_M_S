<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('date_time');
            $table->decimal('payments', 15, 2);
            $table->boolean('doctor_revealed')->default(0)->nullable();
            $table->boolean('lab_detection')->default(0)->nullable();
            $table->boolean('buy_medicine')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
