<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer');
            $table->string('inv');
            $table->date('sell_date');

            $table->string('shift');

            $table->string('cat');
            $table->string('product');

            $table->tinyInteger('delivery_man');

            $table->float('uint_price', 8, 2);
            $table->float('quantity', 8, 2);
            $table->string('unit');
            $table->float('subtotal', 8, 2)->default('0.00');

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
        Schema::dropIfExists('sells');
    }
}
