<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('county_id')->nullable();
            $table->foreign('county_id')
                ->references('id')
                ->on('regions')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->unsignedInteger('region_id')->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->string('district_name');
            $table->string('district_code');
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
        Schema::dropIfExists('districts');
    }
}
