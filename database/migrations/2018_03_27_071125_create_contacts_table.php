<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name')->index();
            $table->unsignedInteger('table_id')->index();
            $table->string('tel_phone', 50)->nullable();
            $table->string('cell_phone', 50)->nullable();
            $table->integer('phone_ext')->nullable();
            $table->string('alt_phone', 50)->nullable();
            $table->string('phone_type',50)->nullable();
            $table->string('fax', 50)->nullable();
            // $table->string('company_email', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('url', 200)->nullable();

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
        Schema::dropIfExists('contacts');
        Schema::enableForeignKeyConstraints();
    }
}
