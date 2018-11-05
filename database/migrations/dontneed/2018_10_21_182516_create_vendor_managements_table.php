<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name')->collation('utf16_general_ci');
            $table->string('contact_person')->collation('utf16_general_ci');

            $table->string('personal_mobile')->unique()->collation('utf16_general_ci');
            $table->string('alt_mobile')->nullable()->collation('utf16_general_ci');
            $table->string('email')->unique()->nullable()->collation('utf16_general_ci');

            $table->tinyInteger('country');
            $table->string('city')->collation('utf16_general_ci');
            $table->string('area')->collation('utf16_general_ci');
            $table->string('post_code')->nullable()->collation('utf16_general_ci');
            $table->string('address')->nullable()->collation('utf16_general_ci');
            $table->string('comment')->nullable()->collation('utf16_general_ci');

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
        Schema::dropIfExists('vendor_managements');
    }
}
