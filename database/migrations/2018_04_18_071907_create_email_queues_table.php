<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_queues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('payload');
            $table->string('table_name',20)->nullable();
            $table->unsignedInteger('application_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->string('name')->nullable();
            $table->string('to')->nullable();
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->boolean('is_send')->default(false);
            $table->boolean('is_failed')->default(false);
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
        Schema::dropIfExists('email_queues');
    }
}
