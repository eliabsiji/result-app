<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Staffacademicinfo1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('staffacademicinfo1', function (Blueprint $table) {
            $table->id();
            $table->string('staffid');
            $table->string('employmentno')->nullable();
            $table->string('institution')->nullable();
            $table->string('discipline')->nullable();
            $table->string('qualification')->nullable();
            $table->string('year')->nullable();
            $table->string('yearteaching')->nullable();
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
        Schema::dropIfExists('staffacademicinfo1');
    }
}
