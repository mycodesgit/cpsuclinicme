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
        Schema::create('patientvisits', function (Blueprint $table) {
            $table->id();
            $table->string('stid')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->text('chief_complaint')->nullable();
            $table->string('treatment')->nullable();
            $table->string('medicine')->nullable()->default(',,,,,');
            $table->string('qty')->nullable()->default(',,,,,');
            $table->string('certificate')->nullable();
            $table->string('defaultfunction')->nullable();
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
        Schema::dropIfExists('patientvisits');
    }
};
