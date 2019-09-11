<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFieldsTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_man_id')->nullable()->index();
            $table->string('field_name')->nullable()->index();
            $table->string('label')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('is_edit')->default(1);
            $table->boolean('is_view')->default(1);
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
        Schema::dropIfExists('table_fields');
    }
}
