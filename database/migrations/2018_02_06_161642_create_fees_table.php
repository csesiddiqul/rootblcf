<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fee_name');
            $table->integer('school_id')->unsigned();
            $table->unsignedBigInteger('type');
            $table->double('amount', 25, 2);
            $table->integer('cycle');
            $table->tinyInteger('cycle_status');
            // $table->string('fine_fee');//penalty
            // $table->string('exam_fee');
            // $table->string('registration_fee');
            // $table->string('library_fee');
            // $table->string('lab_fee');
            // $table->string('sport_fee');
            // $table->string('late_payment_fee');
            // $table->string('maintenance_fee');
            // $table->string('internet_fee');
            // $table->string('farewell_fee');
            // $table->string('other_fee');
            $table->integer('user_id');
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
        Schema::dropIfExists('fees');
    }
}
