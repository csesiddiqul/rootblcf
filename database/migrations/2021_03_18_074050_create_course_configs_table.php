<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_configs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('user_id');
            $table->string('grade_system_name')->nullable();
            $table->integer('quiz_count')->default('0');
            $table->integer('assignment_count')->default('0');
            $table->integer('ct_count')->default('0');
            $table->integer('quiz_percent')->default('0');
            $table->integer('attendance_percent')->default('0');
            $table->integer('assignment_percent')->default('0');
            $table->integer('ct_percent')->default('0');
            $table->integer('final_exam_percent')->default('0');
            $table->integer('practical_percent')->default('0');
            $table->integer('att_fullmark')->default('0');
            $table->integer('quiz_fullmark')->default('0');
            $table->integer('a_fullmark')->default('0');
            $table->integer('ct_fullmark')->default('0');
            $table->integer('final_fullmark')->default('0');
            $table->integer('practical_fullmark')->default('0');
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
        Schema::dropIfExists('course_configs');
    }
}
