<?php

use App\Lib\Database\DefaultsFields;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTemplatesTable extends Migration
{
    use DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('court_id');
            $this->defaultsFields($table);
            $table->timestamps();

            $table->foreign('court_id')->references('id')->on('courts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_templates');
    }
}
