<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('price_type')->comment('1=Installation,2=Service')->index();
            $table->string('code',50); 
            $table->string('title')->index(); 
            $table->double('price',8,2);
            $table->string('country',100)->index();
            $table->longText('details')->nullable();
            $table->tinyInteger('subsMonth')->comment('Subscription Month')->nullable()->index();
            $table->double('perStudent',8,2)->comment('Per Student Fee')->nullable();
            $table->tinyInteger('status')->comment('0=Inactive,1=Active,2=Pending')->default(1)->index();
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
        Schema::dropIfExists('pricings');
    }
}
