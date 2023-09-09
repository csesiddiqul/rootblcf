<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('dona_name')->nullable();
            $table->integer('committees_id')->nullable();
            $table->date('date');
            $table->integer('year')->nullable();
            $table->date('yearstart')->nullable();
            $table->date('yearEnd')->nullable();
            $table->double('subscription',8,2);
            $table->double('registration',8,2);
            $table->double('donation',8,2);
            $table->double('arrears',8,2);
            $table->double('other',8,2);
            $table->double('grants',8,2);
            $table->double('amount',8,2);

            $table->integer('ledger_id');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('memberships');
    }
}
