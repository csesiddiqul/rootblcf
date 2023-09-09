<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLetsEncriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lets_encripts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->string('domain')->nullable();
            $table->ipAddress('initialIp')->nullable();
            $table->bigInteger('account_id')->nullable();
            $table->bigInteger('order_id')->nullable();
            $table->string('status')->nullable();
            $table->string('expires')->nullable();
            $table->string('filename')->nullable();
            $table->text('content')->nullable();
            $table->text('object_url')->nullable();
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
        Schema::dropIfExists('lets_encripts');
    }
}
