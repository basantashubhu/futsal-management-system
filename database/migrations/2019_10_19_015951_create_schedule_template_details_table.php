<?php

use App\Lib\Database\DefaultsFields;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTemplateDetailsTable extends Migration
{
    use DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_template_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('day', 20);
            $table->time('time_in');
            $table->time('time_out');
            $table->time('total_hrs');
            $table->decimal('amount');
            $this->defaultsFields($table);
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
        Schema::dropIfExists('schedule_template_details');
    }
}
