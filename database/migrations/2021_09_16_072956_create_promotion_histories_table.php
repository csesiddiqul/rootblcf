<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('student_id');
            $table->bigInteger('past_section');
            $table->bigInteger('present_section');
            $table->bigInteger('past_session');
            $table->bigInteger('present_session');
            $table->integer('past_roll')->nullable();
            $table->integer('present_roll')->nullable();
            $table->tinyInteger('school_left')->comment('1=Yes,0=No');
            $table->unsignedBigInteger('promoted_by');
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
        Schema::dropIfExists('promotion_histories');
    }
}
