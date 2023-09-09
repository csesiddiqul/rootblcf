<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id')->index();
            $table->unsignedBigInteger('admission_id')->index();
            $table->string('trans_number',15)->nullable()->index();
            $table->string('stripe_charge',150)->nullable();
            $table->string('trans_id',150)->nullable()->index();
            $table->timestamp('trans_date')->nullable()->index();
            $table->tinyInteger('trans_type')->nullable()->comment('1=Stripe,2=SSL')->index();
            $table->string('trans_status',20)->nullable();
            $table->tinyInteger('fee_pay')->default(1)->comment('1=charge with amount,0=charge without amount	');
            $table->double('amount',8,2);
            $table->double('stripe_fee',3,2)->nullable();
            $table->string('currency',10);
            $table->string('card_type',100)->nullable()->comment('For SSL');
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
        Schema::dropIfExists('admission_payments');
    }
}
