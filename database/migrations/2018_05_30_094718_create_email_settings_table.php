<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailSettingsTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('email')->nullable();
            $table->string('email_from')->nullable();
            $table->string('server')->nullable();
            $table->string('password')->nullable();
            $table->string('mail_type')->nullable();
            $table->boolean('is_auth_required')->default(true);
            $table->boolean('is_ssl')->default(true);
            $table->boolean('is_tls')->default(true);
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
        Schema::dropIfExists('email_settings');
    }
}
