<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->bigInteger('section_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('preadmission_id')->unsigned();
            $table->bigInteger('roll')->index();
            $table->string('add_pass')->index()->nullable();
            $table->float('mark',10)->index()->nullable();
            $table->string('name');
            $table->tinyInteger('gender');
            $table->tinyInteger('religon');
            $table->string('dob');
            $table->tinyInteger('bloodgroup')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->string('father_name')->nullable();
            $table->string('signature')->nullable();
            $table->string('fathercell')->nullable();
            $table->string('fatheremail')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mothercell')->nullable();
            $table->string('motheremail')->nullable();
            $table->string('fatheroccupation')->nullable();
            $table->string('motheroccupation')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('contactperson')->nullable();
            $table->string('contactpersonmobile')->nullable();
            $table->string('realation')->nullable();
            $table->string('presentAddress')->nullable();
            $table->string('perpostoffice')->nullable();
            $table->string('perpostcode')->nullable();
            $table->string('pastAddress')->nullable();
            $table->string('pastpostoffice')->nullable();
            $table->string('pastpostcode')->nullable();
            $table->string('birthcertificateNo')->nullable();
            $table->string('fatherPassport')->nullable();
            $table->string('gName')->nullable();
            $table->string('gNationality')->nullable();
            $table->string('gMobile')->nullable();
            $table->string('gEmail')->nullable();
            $table->string('gdate')->nullable();
            $table->string('gnrcNo')->nullable();
            $table->string('gPhone')->nullable();
            $table->string('gAddress')->nullable();
            $table->string('gOccupation')->nullable();
            $table->string('cemail')->nullable();
            $table->tinyInteger('singaporepr')->nullable();
            $table->string('preDivision')->nullable();
            $table->string('preDistrict')->nullable();
            $table->string('preThana')->nullable();
            $table->string('pastDivision')->nullable();
            $table->string('pastDistrict')->nullable();
            $table->string('pastThana')->nullable();
            $table->string('bengaliLang')->nullable();
            $table->string('placeBirth')->nullable();
            $table->string('remark')->nullable();
            $table->string('streetAddress_1')->nullable();
            $table->string('streetAddress_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('country')->nullable();
            $table->text('nameAddressofmainSchool')->nullable();
            $table->text('admissioninbengaliClass')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('admissions');
    }
}
