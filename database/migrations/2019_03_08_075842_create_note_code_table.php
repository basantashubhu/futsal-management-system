<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteCodeTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_code', function (Blueprint $table) {
            $table->increments('id')->index()->unique();
            $table->unsignedInteger('prg_no')->nullable()->index()->unique();
            $table->string('note_code')->nullable()->index()->unique();

            $table->string('note_desc')->nullable();
            $table->tinyInteger('note_active')->nullable();
            $table->string('alert_icon')->nullable()->index();
            $table->string('alt_flag')->nullable()->index();
            $table->dateTime('color_code')->nullable();
            $table->unsignedInteger('seqno')->nullable();
            
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
        Schema::dropIfExists('note_code');
    }
}
