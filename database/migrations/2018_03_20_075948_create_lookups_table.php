<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLookupsTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',  100);
            $table->string('value', 200);
            $table->string('type')->nullable();
            $table->unsignedInteger('sequence_num')->nullable();
            $table->enum('datatype',['string', 'float', 'integer', 'date', 'datetime'])->default('string');
            $table->boolean('has_lookup')->default(0);
            $table->text('description')->nullable();
            $table->string('section',50)->nullable();
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
        Schema::dropIfExists('lookups');
    }
}
