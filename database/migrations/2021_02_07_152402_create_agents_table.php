<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('district_id')->nullable()->index();
            $table->unsignedBigInteger('state_id')->nullable()->index();
            $table->string('city',100)->nullable();
            $table->string('nid',20)->nullable();
            $table->string('nid_url')->nullable();
            $table->double('percentage',8,2);
            $table->string('bank_name',100)->nullable();
            $table->string('ac_name',100)->nullable();
            $table->string('ac_number',30)->nullable();
            $table->string('ac_branch',100)->nullable();
            $table->string('ac_routing',100)->nullable();
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
        Schema::dropIfExists('agents');
    }
}
