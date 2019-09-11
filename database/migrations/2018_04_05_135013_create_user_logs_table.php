<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLogsTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->dateTime('login_timestamp')->nullable();
            $table->dateTime('last_login_timestamp')->nullable();
            $table->dateTime('last_call_timestamp')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_kickout')->default(false);
            $table->string('fingerprint')->nullable();
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->string('cpu')->nullable();
            $table->string('timezone')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('user_logs');
    }
}
