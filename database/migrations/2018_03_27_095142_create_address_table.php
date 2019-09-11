<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name')->index();
            $table->unsignedInteger('table_id')->index();

            $table->string('add1', 100);
            $table->string('add2', 100)->nullable();

            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('district')->nullable();
            $table->string('county')->nullable();
             $table->string('region')->nullable();
            $table->string('state')->nullable();


            /*
             * using zip_codes table as lookup table for query and suggestions
             * removing unwanted columns from table
             * */
//            $table->unsignedInteger('zip_id')->nullable();
//            $table->foreign('zip_id')->references('id')->on('zip_codes')->onUpdate('cascade')->onDelete('restrict');

            // $table->unsignedInteger('client_id')->nullable();
            // $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade')->onDelete('restrict');

            // $table->unsignedInteger('org_id')->nullable();
            // $table->foreign('org_id')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('restrict');

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
        Schema::dropIfExists('address');
        Schema::enableForeignKeyConstraints();
    }
}
