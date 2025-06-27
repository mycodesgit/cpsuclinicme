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
        Schema::create('patientreferral', function (Blueprint $table) {
            $table->id();
            $table->string('stid')->nullable();
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->string('preferfrom')->nullable();
            $table->string('preferto')->nullable();
            $table->text('reasonrefer')->nullable();
            $table->text('tentdiagnose')->nullable();
            $table->text('treatmentmedgiven')->nullable();
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
        Schema::dropIfExists('patientreferral');
    }
};
