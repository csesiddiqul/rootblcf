<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('section_number');
            $table->integer('room_number');
            $table->integer('class_id')->unsigned();
            $table->integer('user_id')->unsigned()->default(0);
            $table->tinyInteger('status')->default(1)->comment('1=active,2=inactive');
            $table->double('add_amount', 8, 2)->default(0)->comment('admission amount');
            $table->integer('add_total')->default(0)->comment('admission total student');
            $table->tinyInteger('lottery')->default(0)->comment('admission lottery complete or not');
            $table->tinyInteger('lottery_on_mark')->default(0)->comment('0=without mark,1=with mark');
            $table->tinyInteger('lottery_sms')->default(0)->comment('0=no;1=yes');
            $table->tinyInteger('waiting_1')->default(0);
            $table->tinyInteger('waiting_2')->default(0);
            $table->tinyInteger('waiting_3')->default(0);
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
        Schema::dropIfExists('sections');
    }
}
