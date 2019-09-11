<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaveLoadEmailsTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_load_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('section')->nullable();
            $table->string('subject')->nullable();
            $table->longText('message')->nullable();
            $table->boolean('attachment')->nullable();
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
        Schema::dropIfExists('save_load_emails');
    }
}
