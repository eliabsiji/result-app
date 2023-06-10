<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Staffacademicinfo3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('staffacademicinfo3', function (Blueprint $table) {
            $table->id();
            $table->string('staffid');
            $table->string('employmentno')->nullable();
            $table->string('institution3')->nullable();
            $table->string('discipline3')->nullable();
            $table->string('qualification3')->nullable();
            $table->string('year3')->nullable();
            $table->string('yearteaching3')->nullable();
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
        Schema::dropIfExists('staffacademicinfo3');
    }
}
