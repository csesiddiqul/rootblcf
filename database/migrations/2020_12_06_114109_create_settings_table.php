<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->string('slogan')->nullable();
            $table->string('eiin', 50)->nullable();
            $table->string('email')->nullable()->index();
            $table->string('phone')->nullable()->index();
            $table->string('telephone')->nullable()->index();
            $table->string('standard')->nullable();
            $table->string('icon')->nullable();
            $table->string('express')->nullable();
            $table->tinyInteger('logo_type')->default(1)->comment('1=Express,2=Standard');
            $table->string('about_pic')->nullable();
            $table->string('timezone')->nullable();
            $table->string('language')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('google_analytics')->nullable();
            $table->string('tracking_code')->nullable();
            $table->string('meta_tags')->nullable();
            $table->string('meta_disc')->nullable();
            $table->string('site_map')->nullable();
            $table->string('contact_title')->nullable();
            $table->tinyInteger('user_verify')->default('1')->comment('1=yes,0=no');
            $table->tinyInteger('admission_form')->default('1')->comment('1=published,0=unpublished');
            $table->tinyInteger('admission_verify')->default('0');
            $table->tinyInteger('add_payment_status')->default('0')->comment('0=without payment,1=with payment');
            $table->double('admissionAmount',8,2)->default('200');
            $table->tinyInteger('add_amount_charge')->default('1')->comment('1=Stripe/Sslcommerz charge with amount,0=Stripe/Sslcommerz charge without amount');
            $table->tinyInteger('admission_status')->default('1')->comment('1=published,0=unpublished');
            $table->tinyInteger('admission_exam')->default('0')->comment('1=yes,0=no');
            $table->tinyInteger('admit_card')->default('0')->comment('1=yes,0=no');
            $table->integer('admi_card_template')->nullable();
            $table->tinyInteger('admission_result')->default('0')->comment('1=yes,0=no');
            $table->timestamp('add_result_pubtime')->nullable()->comment('if admission_result is 1,then when published result time. Result will automatically published this date time');
            $table->integer('admission_student')->default('0')->comment('Total student per admission for effect admission result published');
            $table->tinyInteger('admission_show_mark')->default('0')->comment('1=yes,0=no');
            $table->tinyInteger('waiting1_status')->default(0)->comment('0=no;1=yes');
            $table->tinyInteger('waiting2_status')->default(0)->comment('0=no;1=yes');
            $table->tinyInteger('waiting3_status')->default(0)->comment('0=no;1=yes');
            $table->tinyInteger('site_published')->default('1')->comment('1=yes,0=no');
            $table->string('unpublished_msg')->nullable()->comment('if site_published is 1, then write message why siteUnPublished');
            $table->tinyInteger('invoice_copy')->default('1');
            $table->tinyInteger('invoice_template')->default('1');
            $table->tinyInteger('sms_self')->default('0')->comment('0=master_school,1=self_school');
            $table->string('sms_api_key')->nullable();
            $table->string('sms_sender_id')->nullable();
            $table->tinyInteger('admission_submit_sms')->default('0')->comment('1=yes,0=no');
            $table->tinyInteger('admission_submit_admin_sms')->default('0')->comment('1=yes,0=no');
            $table->tinyInteger('admission_payment_sms')->default('0')->comment('1=yes,0=no');
            $table->tinyInteger('admission_approved_sms')->default('0')->comment('1=yes,0=no');
            $table->tinyInteger('notification_sms')->default('0')->comment('1=yes,0=no');
            $table->tinyInteger('ssl_self')->default('0')->comment('0=master_school,1=self_school');
            $table->string('ssl_store_id')->nullable();
            $table->string('ssl_store_password')->nullable();
            $table->tinyInteger('breaking_news')->default('0')->comment('1=yes,0=no');
            $table->tinyInteger('breaking_news_position')->default('1')->comment('1=Site Top,2=Top bar Bottom,3=Slider Bottom');
            $table->string('breaking_news_bg',50)->default('0077f7');
            $table->string('breaking_news_tc',50)->default('FFFFFF');
            $table->tinyInteger('marksheet_tem')->default('1')->comment('1=Template One,2=Template Two');
            $table->tinyInteger('marksheet_ctn')->default('1')->comment('1=yes,0=no');
            $table->tinyInteger('marksheet_address')->default('1')->comment('1=yes,0=no');
            $table->tinyInteger('marksheet_established')->default('1')->comment('1=yes,0=no');
            $table->tinyInteger('marksheet_signature')->default('1')->comment('1=yes,0=no');
            $table->tinyInteger('marksheet_signature_type')->default('1')->comment('1=Head Of the Institute,2=Principal Signature & Signature of Class Teacher,3=Principal Signature & Signature of Class Teacher & Signature of Guardian');
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
        Schema::dropIfExists('settings');
    }
}
