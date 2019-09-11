<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessiondataTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessiondata', function (Blueprint $table) {
            $table->increments('id')->unique()->index();
            $table->string('session_id')->nullable()->index()->unique();
            $table->string('session_name')->nullable()->index()->unique();
            $table->string('session_value')->nullable();
            $this->defaultsFieldsNew($table);
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
        Schema::dropIfExists('sessiondata');
    }
}
