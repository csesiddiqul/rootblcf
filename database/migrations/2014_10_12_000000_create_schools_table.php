<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->bigInteger('parent_id');
            $table->bigInteger('reseller_id')->index()->nullable();
            $table->string('branch_code')->nullable(); // short code
            $table->bigInteger('country_id')->index();
            $table->bigInteger('state_id')->index()->nullable();
            $table->bigInteger('district_id')->index()->nullable();
            $table->string('city')->nullable();
            $table->string('established')->default('');
            $table->text('about')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->string('address');
            $table->string('medium');//bn,en
            $table->integer('code')->unique();
            $table->integer('secretKey')->nullable();
            $table->string('theme');
            $table->string('agentcode', 20)->nullable()->index();
            $table->tinyInteger('status')->default(1)->comment('0=delete,1=active,2=deactive');
            $table->double('perStudent', 8, 2)->nullable();
            $table->datetime('activeTill')->nullable();
            $table->datetime('lastCharged')->nullable();
            $table->integer('sms_count')->default(0);
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
        Schema::dropIfExists('schools');
    }
}
