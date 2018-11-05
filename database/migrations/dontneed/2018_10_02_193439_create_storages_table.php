<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('inv');
            $table->date('store_date');;

            $table->string('cat');
            $table->string('product');
            $table->string('storage_type');
            $table->float('quantity', 8, 2);
            $table->string('unit');
            $table->text('comment')->nullable();
            $table->string('customer')->nullable();

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
        Schema::dropIfExists('storages');
    }
}
