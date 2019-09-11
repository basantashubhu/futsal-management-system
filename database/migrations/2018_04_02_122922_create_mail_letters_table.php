<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailLettersTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_letters', function (Blueprint $table) {
            $this->down();
            $table->increments('id');
            $table->string('table', 50)->nullable();
            $table->unsignedInteger('table_id')->nullable();
            $table->dateTime('scheduled_date')->nullable();
            $table->string('mail_sp')->nullable();
            $table->string('tracking_no')->nullable();
            $table->string('tracking_url')->nullable();
            $table->string('status')->default('Pending');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('mail_letters');
    }
}
