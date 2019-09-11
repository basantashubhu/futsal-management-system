<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotetypeTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notetype', function (Blueprint $table) {
            $table->increments('id')->index()->unique();
            $table->unsignedInteger('prg_no')->nullable()->index()->unique();
            $table->string('note_type')->nullable()->index();

            $table->string('note_desc')->nullable();
            $table->tinyInteger('note_active')->nullable();
            $table->string('note_code')->nullable()->index();
            $table->unsignedInteger('seqno')->nullable()->index();
            
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
        Schema::dropIfExists('notetype');
    }
}
