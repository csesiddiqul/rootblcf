<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjustmentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjustment_reports', function (Blueprint $table) {
            $table->id();

            $table->integer('old_ledger');
            $table->integer('new_ledger');
            $table->integer('old_amount');
            $table->integer('new_amount');
            $table->unsignedBigInteger('old_user_id');
            $table->unsignedBigInteger('new_user_id');
            $table->unsignedBigInteger('old_account_sector_id');
            $table->unsignedBigInteger('new_account_sector_id');
            $table->string('old_name');
            $table->string('new_name');
            $table->date('old_date');
            $table->date('new_date');
            $table->unsignedBigInteger('financialYear_id');
            $table->string('voucher_no');
            $table->unsignedBigInteger('school_id');

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
        Schema::dropIfExists('adjustment_reports');
    }
}
