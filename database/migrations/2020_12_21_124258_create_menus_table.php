<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('school_id')->unsigned();
            $table->string('name')->index();
            $table->integer('priority')->nullable();
            $table->bigInteger('parent')->default(0);
            $table->tinyInteger('url')->nullable()->comment('1=url,2=dropdown');
            $table->string('slug')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('type')->default(2)->comment('1=static,2=dynamic');
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
        Schema::dropIfExists('menus');
    }
}
