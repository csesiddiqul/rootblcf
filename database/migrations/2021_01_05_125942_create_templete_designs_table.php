<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempleteDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templete_designs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->tinyInteger('type')->comment('1=admission admit,2=exam admit,3=marksheet')->nullable();
            $table->string('name');
            $table->string('heading')->nullable();
            $table->string('examname')->nullable();
            $table->string('examdate');
            $table->string('examcenter')->nullable();
             $table->tinyInteger('info_position')->nullable();
            $table->tinyInteger('is_name')->nullable();
            $table->tinyInteger('is_fname')->nullable();
            $table->tinyInteger('is_mname')->nullable();
            $table->tinyInteger('is_email')->nullable();
            $table->tinyInteger('is_phone')->nullable();
            $table->tinyInteger('is_address')->nullable();
            $table->tinyInteger('is_admission_id')->nullable();
            $table->tinyInteger('is_st_id')->nullable();
            $table->tinyInteger('is_photo')->nullable();
            $table->tinyInteger('photo_position')->nullable();
            $table->tinyInteger('is_class')->nullable();
            $table->tinyInteger('is_section')->nullable();
            $table->tinyInteger('is_session')->nullable();
            $table->enum('page', ['a4', 'a5']);
            $table->string('llogo')->nullable();
            $table->string('rlogo')->nullable();
            $table->string('mlogo')->nullable();
            $table->string('msign')->nullable();
            $table->string('lsign')->nullable();
            $table->string('rsign')->nullable();
            $table->string('lsign_title')->nullable();
            $table->string('msign_title')->nullable();
            $table->string('rsign_title')->nullable();
            $table->string('bgimg')->nullable();
            $table->text('bodyText')->nullable();
            $table->text('footerText')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('templete_designs');
    }
}
