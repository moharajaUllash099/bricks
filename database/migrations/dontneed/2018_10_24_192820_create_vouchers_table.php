<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('branch');
            $table->string('voucher');
            $table->date('v_date');
            $table->string('pay_to')->collation('utf16_general_ci');

            $table->string('cost_cat');
            $table->string('cost_item');
            $table->string('vendor');
            $table->string('ref')->nullable()->collation('utf16_general_ci');
            $table->float('total_bill', 8, 2);
            $table->float('due_amount', 8, 2)->default('0.00');
            $table->text('comment')->nullable()->collation('utf16_general_ci');

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
        Schema::dropIfExists('vouchers');
    }
}
