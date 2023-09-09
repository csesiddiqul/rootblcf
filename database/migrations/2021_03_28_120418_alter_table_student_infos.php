<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableStudentInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_infos', function (Blueprint $table) {
            $table->string('height')->nullable()->default(null);
            $table->string('weight')->nullable()->default(null);
            $table->string('signature')->nullable()->default(null);
            $table->string('father_email')->nullable()->default(null);
            $table->string('mother_email')->nullable()->default(null);
            $table->string('father_passport')->nullable()->default(null);
            $table->string('contact_person')->nullable()->default(null);
            $table->string('contact_person_mobile')->nullable()->default(null);
            $table->string('contact_person_email')->nullable()->default(null);
            $table->string('relation_with_cperson')->nullable()->default(null);
            $table->string('present_address')->nullable()->default(null);
            $table->string('present_post_office')->nullable()->default(null);
            $table->string('present_postcode')->nullable()->default(null);
            $table->string('present_thana')->nullable()->default(null);
            $table->string('present_district')->nullable()->default(null);
            $table->string('present_division')->nullable()->default(null);
            $table->string('permanent_address')->nullable()->default(null);
            $table->string('permanent_post_office')->nullable()->default(null);
            $table->string('permanent_postcode')->nullable()->default(null);
            $table->string('permanent_thana')->nullable()->default(null);
            $table->string('permanent_district')->nullable()->default(null);
            $table->string('permanent_division')->nullable()->default(null);
            $table->string('dob_no')->nullable()->default(null)->comment('Birth Certificate No');
            $table->string('gName')->nullable()->default(null)->comment('G for Guardian/Parents');
            $table->string('gNationality')->nullable()->default(null);
            $table->string('gMobile')->nullable()->default(null);
            $table->string('gEmail')->nullable()->default(null);
            $table->string('gdate')->nullable()->default(null);
            $table->string('gnric_no')->nullable()->default(null)->comment('NRIC No./Passport No.');
            $table->string('gPhone')->nullable()->default(null);
            $table->string('gAddress')->nullable()->default(null);
            $table->string('gOccupation')->nullable()->default(null);
            $table->tinyInteger('singaporepr')->nullable()->default(null);
            $table->string('bengaliLang')->nullable()->default(null);
            $table->string('placeBirth')->nullable()->default(null);
            $table->string('street_address_1')->nullable()->default(null);
            $table->string('street_address_2')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('state')->nullable()->default(null);
            $table->string('zipCode')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->float('admission_mark',10)->nullable()->default(null);
            $table->string('main_school_name_address')->nullable()->default(null);
            $table->string('admission_bengali_class')->nullable()->default(null);
            $table->integer('class_roll')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_infos', function (Blueprint $table) {
            $table->dropColumn('height');
            $table->dropColumn('weight');
            $table->dropColumn('signature');
            $table->dropColumn('father_email');
            $table->dropColumn('mother_email');
            $table->dropColumn('father_passport');
            $table->dropColumn('contact_person');
            $table->dropColumn('contact_person_mobile');
            $table->dropColumn('contact_person_email');
            $table->dropColumn('relation_with_cperson');
            $table->dropColumn('present_address');
            $table->dropColumn('present_post_office');
            $table->dropColumn('present_postcode');
            $table->dropColumn('present_thana');
            $table->dropColumn('present_district');
            $table->dropColumn('present_division');
            $table->dropColumn('permanent_address');
            $table->dropColumn('permanent_post_office');
            $table->dropColumn('permanent_postcode');
            $table->dropColumn('permanent_thana');
            $table->dropColumn('permanent_district');
            $table->dropColumn('permanent_division');
            $table->dropColumn('dob_no');
            $table->dropColumn('gName');
            $table->dropColumn('gNationality');
            $table->dropColumn('gMobile');
            $table->dropColumn('gEmail');
            $table->dropColumn('gdate');
            $table->dropColumn('gnric_no');
            $table->dropColumn('gPhone');
            $table->dropColumn('gAddress');
            $table->dropColumn('gOccupation');
            $table->dropColumn('singaporepr');
            $table->dropColumn('bengaliLang');
            $table->dropColumn('placeBirth');
            $table->dropColumn('street_address_1');
            $table->dropColumn('street_address_2');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('zipCode');
            $table->dropColumn('country');
            $table->dropColumn('admission_mark');
            $table->dropColumn('main_school_name_address');
            $table->dropColumn('admission_bengali_class');
        });
    }
}
