<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Staffacademicinfo2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('staffacademicinfo2', function (Blueprint $table) {
            $table->id();
            $table->string('staffid');
            $table->string('employmentno')->nullable();
            $table->string('institution2')->nullable();
            $table->string('discipline2')->nullable();
            $table->string('qualification2')->nullable();
            $table->string('year2')->nullable();
            $table->string('yearteaching2')->nullable();
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
        Schema::dropIfExists('staffacademicinfo2');
    }
}
