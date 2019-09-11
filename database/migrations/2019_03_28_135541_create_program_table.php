<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program', function (Blueprint $table) {
            $table->increments('id');
            $table->string('property')->index();
            $table->string('value')->nullable();
            $table->longText('value2')->nullable();
            $table->timestamps();
        });
        Schema::create('program_default', function(Blueprint $table) {
            $table->increments('id');
            $table->string('property');
            $table->string('value')->nullable();
            $table->longText('value2')->nullable();
            $table->boolean('deletable')->default(1);
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
        Schema::dropIfExists('program_default');
        Schema::dropIfExists('program');
    }
}
