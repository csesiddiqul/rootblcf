<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complains', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('school_id');
            $table->string('name');
            $table->string('contactnumber')->nullable();
            $table->string('email')->nullable();
            $table->longText('description')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->string('remark')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('complains');
    }
}
