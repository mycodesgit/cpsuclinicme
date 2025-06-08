<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('stid')->nullable()->index();
            $table->string('stdntid')->nullable()->index();
            $table->string('lname')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('ext_name')->nullable();
            $table->string('category')->nullable();
            $table->date('birthdate')->nullable();
            $table->integer('age')->nullable();
            $table->string('sex')->nullable();
            $table->string('home_region')->nullable();
            $table->string('home_province')->nullable();
            $table->string('home_city')->nullable();
            $table->string('home_brgy')->nullable();
            $table->string('contact')->nullable();
            $table->string('stud_nation')->nullable();
            $table->string('stud_religion')->nullable();
            $table->string('c_status')->nullable();
            $table->string('studCollege')->nullable();
            $table->string('studCourse')->nullable();
            $table->string('office')->nullable();
            $table->string('guardian')->nullable();
            $table->string('guardian_occup')->nullable();
            $table->string('guardian_contact')->nullable();
            $table->string('guardian_region')->nullable();
            $table->string('guardian_province')->nullable();
            $table->string('guardian_city')->nullable();
            $table->string('guardian_brgy')->nullable();
            $table->string('height_cm')->nullable();
            $table->string('height_ft')->nullable();
            $table->string('weight_kg')->nullable();
            $table->string('weight_lb')->nullable();
            $table->string('bmi')->nullable()->default(';');
            $table->string('temp')->nullable();
            $table->integer('pr')->nullable(); // pulse rate
            $table->string('bp')->nullable();  // blood pressure
            $table->integer('rr')->nullable(); // respiratory rate
            $table->string('disease')->default(',,,,,,,,,,,,,,,,,,,')->nullable();
            $table->string('disease_rem')->default(',,,,,,,,,,,,,,,,,,,')->nullable();
            $table->string('hospital_confine')->default('0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0');
            $table->string('date_hospitaliz')->nullable()->default(',,,,,,,,,,,,,,,,,,,');
            $table->string('date_hospitaliz1')->nullable()->default(',,,,,,,,,,,,,,,,,,,');
            $table->string('immunization1')->nullable()->default(',,,,,,,');
            $table->string('immunization2')->nullable()->default(',,,,,,,');
            $table->string('smoking')->nullable()->default(',');
            $table->string('drinking')->nullable()->default(',,,');
            $table->string('Menarche')->nullable();
            $table->string('Duration')->nullable();
            $table->string('Interval')->nullable();
            $table->string('pads_use')->nullable();
            $table->text('mens_symp')->nullable();
            $table->date('lmp')->nullable();
            $table->string('en_pexam')->nullable()->default(',,,,,,,,,,,,,');
            $table->text('findings_pexam')->nullable()->default(',,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,');
            $table->text('other_pexam')->nullable()->default(',,,,,,,,,,,,,');
            $table->text('other_find')->nullable();
            $table->string('pexam_pwd')->nullable()->default('1');
            $table->text('pexam_remarks')->nullable();
            $table->string('pend_reason')->nullable();
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
        Schema::dropIfExists('patients');
    }
};
