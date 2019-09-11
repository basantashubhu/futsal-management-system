<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZipCodesTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zip_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('zip_code')->nullable();
            $table->string('city', 200)->nullable();
            $table->string('county', 200)->nullable();
            $table->string('state', 200)->nullable();
            $table->string('district', 200)->nullable();
            $table->string('region')->nullable();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('zip_codes');
        Schema::enableForeignKeyConstraints();
    }
}
