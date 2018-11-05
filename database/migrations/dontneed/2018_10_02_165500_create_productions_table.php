<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->increments('id');

            $table->string('inv');
            $table->date('pro_date');;

            $table->string('cat');
            $table->string('product');
            $table->float('quantity', 8, 2);
            $table->string('unit');

            $table->string('create_by');
            $table->string('updated_by');
            $table->string('branch');
            $table->string('shift');

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
        Schema::dropIfExists('productions');
    }
}
