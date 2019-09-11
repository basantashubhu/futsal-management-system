<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeveloperNotesTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('page', 50)->nullable();
            $table->longText('text')->nullable();
            $table->longText('feedback')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_done')->default(false);
            $table->dateTime('is_done_date')->nullable();
            $table->unsignedInteger('is_done_by')->nullable();
            $table->unsignedInteger('assigned_to')->nullable();
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
        Schema::dropIfExists('developer_notes');
    }
}
