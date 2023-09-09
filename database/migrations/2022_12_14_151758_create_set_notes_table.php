<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_notes', function (Blueprint $table) {
            $table->id();
            $table->string('auditor1st');
            $table->string('auditor2st');
            $table->string('treasurer');
            $table->longText('notes');
            $table->longText('auditors_report');
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
        Schema::dropIfExists('set_notes');
    }
}
