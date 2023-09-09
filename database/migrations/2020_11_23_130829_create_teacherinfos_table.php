<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacherinfos', function (Blueprint $table) { 
            $table->bigIncrements('id');  
            $table->bigInteger('user_id')->unsigned()->index(); 
            $table->tinyInteger('level_of_education');
            $table->string('exam_degree_title',150); 
            $table->string('others',100); 
            $table->string('result',10);
            $table->string('group',50);
            $table->string('institution',191);
            $table->string('duration',50);
            $table->year('year_of_passing'); 
            $table->tinyInteger('status')->default('1'); 
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
        Schema::dropIfExists('teacherinfos');
    }
}
