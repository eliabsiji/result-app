<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Staffbioinfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('staffbioinfo', function (Blueprint $table) {
            $table->id();
            $table->string('userid');
            $table->string('employmentid')->nullable();
            $table->string('title')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('maritalstatus')->nullable();
            $table->string('numberofchildren')->nullable();
            $table->string('spousenumber')->nullable();
            $table->string('address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('state')->nullable();
            $table->string('local')->nullable();
            $table->string('religion')->nullable();
            $table->string('dateofbirth')->nullable();
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
        //
        Schema::dropIfExists('staffbioinfo');
    }
}
