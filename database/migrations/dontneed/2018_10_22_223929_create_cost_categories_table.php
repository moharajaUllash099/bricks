<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->collation('utf16_general_ci');
            $table->boolean('is_deleted')->default(false)->comment('0 = active, 1 = not active');
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
        Schema::dropIfExists('cost_categories');
    }
}
