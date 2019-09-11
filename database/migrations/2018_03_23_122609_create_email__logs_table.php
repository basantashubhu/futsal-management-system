<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailLogsTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email__logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table');
            $table->integer('table_id');
            $table->string('from');
            $table->string('to');
            $table->string('cc');
            $table->string('sub');
            $table->text('msg');
            $table->string('sent_status');
            $table->dateTime('sent_date');
            $table->text('error_msg');
            $table->dateTime('schedule_date');
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
        Schema::dropIfExists('email__logs');
    }
}
