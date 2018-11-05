<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDuePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('due_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('inv');
            $table->date('inv_date');
            $table->string('branch');
            $table->tinyInteger('uid')->comment('who get this payment');
            $table->tinyInteger('customer')->comment('customer id');
            $table->float('due_left', 8, 2)->default('0.00');
            $table->float('payment', 8, 2)->default('0.00');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('due_payments');
    }
}
