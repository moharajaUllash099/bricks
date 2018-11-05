<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer');
            $table->string('inv');
            $table->date('sell_date');
            $table->string('shift');
            $table->float('total_subtotal', 8, 2)->default('0.00');;
            $table->float('vat', 8, 2)->default('0.00');
            $table->float('total', 8, 2)->default('0.00');
            $table->float('discount', 8, 2)->default('0.00');
            $table->float('total_bill', 8, 2)->default('0.00');
            $table->float('receive', 8, 2)->default('0.00');
            $table->float('advance', 8, 2)->default('0.00');
            $table->float('due', 8, 2)->default('0.00');
            $table->float('change_amount', 8, 2)->default('0.00');
            $table->string('create_by');
            $table->string('updated_by');
            $table->string('branch');
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
        Schema::dropIfExists('payments');
    }
}
