<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountiesTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('region_id')->nullable();
              $table->foreign('region_id')
                 ->references('id')
                 ->on('regions')
                 ->onUpdate('cascade')
                 ->onDelete('restrict');
            $table->unsignedInteger('state_id')->nullable();

            $table->string('county_name');
            $table->text('description')->nullable();

            $table->string('county_code');

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
        Schema::dropIfExists('counties');
    }
}
