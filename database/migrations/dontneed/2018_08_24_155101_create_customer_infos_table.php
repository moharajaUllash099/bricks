<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->collation('utf16_general_ci');
            $table->tinyInteger('type');
            $table->tinyInteger('discount_type');
            $table->string('personal_mobile')->unique()->collation('utf16_general_ci');
            $table->string('alt_mobile')->nullable()->collation('utf16_general_ci');
            $table->string('nid')->unique()->nullable()->collation('utf16_general_ci');
            $table->string('email')->unique()->nullable()->collation('utf16_general_ci');
            $table->tinyInteger('country');
            $table->string('city')->collation('utf16_general_ci');
            $table->string('area')->collation('utf16_general_ci');
            $table->string('post_code')->nullable()->collation('utf16_general_ci');
            $table->string('house_address')->nullable()->collation('utf16_general_ci');
            $table->string('comment')->nullable()->collation('utf16_general_ci');
            $table->string('img')->nullable()->collation('utf16_general_ci');
            $table->string('cid')->comment('createing user id');
            $table->string('uid')->comment('updating user id');
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
        Schema::dropIfExists('customer_infos');
    }
}
