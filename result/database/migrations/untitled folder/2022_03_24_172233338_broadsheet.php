<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Broadsheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('broadsheet', function (Blueprint $table) {
            $table->id();
            $table->string('studentId')->nullable();
            $table->string('subjectclassid')->nullable();
            $table->string('staffid')->nullable();
            $table->string('ca1')->nullable();
            $table->string('ca2')->nullable();
            $table->string('exam')->nullable();
            $table->string('total')->nullable();
            $table->string('grade')->nullable();
            $table->string('allsubjectstotalscores')->nullable();
            $table->string('subjectpositionclass')->nullable();
            $table->string('cmin')->nullable();
            $table->string('cmax')->nullable();
            $table->string('avg')->nullable();
            $table->string('remark')->nullable();
            $table->string('termid')->nullable();
            $table->string('session')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration s.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('broadsheet');
    }
}
