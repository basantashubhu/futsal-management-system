<?php

use App\Lib\Database\DefaultsFields;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    use DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('court_id');
            $table->unsignedInteger('user_id');
            $table->date('date');
            $table->time('time_in');
            $table->time('time_out');
            $table->time('total_hrs');
            $table->decimal('amount');
            $this->defaultsFields($table);
            $table->timestamps();

            $table->foreign('court_id')->references('id')->on('courts');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
