<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function ($table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('school_id')->index();
            $table->unsignedBigInteger('school_payment_id')->index();
            $table->tinyInteger('month');
            $table->integer('quantity')->default(1);
            $table->double('price',8,2);
            $table->datetime('rangeFrom')->nullable();
            $table->datetime('rangeTo')->nullable();
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
         Schema::dropIfExists('subscriptions');
    }
}
