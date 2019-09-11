<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMaintenancesTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name')->index();
            $table->string('label')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedInteger('seq_no')->nullable();
            $table->unsignedInteger('user_id')->nullable();
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
        Schema::dropIfExists('table_maintenances');
    }
}
