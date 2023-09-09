<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committees', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id')->unsigned();
            $table->string('name');
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('religon')->nullable();
            $table->string('dob',50)->nullable();
            $table->tinyInteger('bloodgroup')->nullable();
            $table->string('email')->nullable();
            $table->string('nid')->nullable();
            $table->string('mobile')->nullable();
            $table->string('profession')->nullable();
            $table->string('education')->nullable();
            $table->string('designation')->nullable();
            $table->tinyInteger('marritalstatus')->nullable();
            $table->string('startdate',50)->nullable();
            $table->string('enddate',50)->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('priority')->nullable();
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
        Schema::dropIfExists('committees');
    }
}
