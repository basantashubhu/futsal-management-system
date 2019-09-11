<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensedataTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licensedata', function (Blueprint $table) {
            $table->increments('id')->index()->unique();
            $table->string('cust_name')->nullable();

            $table->unsignedInteger('licenses')->nullable();
            $table->string('license_key')->nullable();
            $table->string('license_type')->nullable()->index();
            $table->unsignedInteger('cust_no')->nullable()->index();
            $table->dateTime('lastchgdate')->nullable();
            $table->unsignedInteger('lastchgtime')->nullable();
            $table->string('lastchguser')->nullable();
            
            $table->unsignedInteger('audit_key')->nullable();

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
        Schema::dropIfExists('licensedata');
    }
}
