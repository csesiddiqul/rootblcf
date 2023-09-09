<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('trans_number',15)->nullable()->index();
            $table->string('stripe_charge',150)->nullable();
            $table->string('trans_id',150)->nullable()->index();
            $table->timestamp('trans_date')->nullable()->index();
            $table->tinyInteger('trans_type')->nullable()->comment('1=Stripe,2=SSL')->index();
            $table->string('trans_status',20)->nullable();
            $table->double('amount',8,2);
            $table->double('stripe_fee',3,2)->nullable();
            $table->string('currency',10);
            $table->string('card_type',100);
            $table->integer('purpose_id')->index();
            $table->string('agentcode',20)->nullable()->index();
            $table->string('ref_number',20)->nullable()->index();
            $table->tinyInteger('month')->nullable();
            $table->datetime('rangeFrom')->nullable();
            $table->datetime('rangeTo')->nullable();
            $table->string('transBy')->default('School');
            $table->double('shareOf',8,2);
            $table->double('percentTk',8,2);
            $table->tinyInteger('pStatus')->default('0')->comment('0=Unpaid,1=Paid to Agent')->index();
            $table->string('tranCheque',15)->nullable()->comment('Foqas to Agent Payment Number')->index();
            $table->string('sNote',15)->nullable()->comment('Tracking comment')->index();
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
        Schema::dropIfExists('school_payments');
    }
}
