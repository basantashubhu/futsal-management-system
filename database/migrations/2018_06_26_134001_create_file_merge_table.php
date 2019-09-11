<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileMergeTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_merge', function (Blueprint $table) {
            $table->increments('id');
            $table->string('report_name');
            $table->boolean('is_print')->default('0');
            $table->boolean('is_send')->default('0');
            $table->string('approval_letter')->nullable();
            $table->string('denial_letter')->nullable();
            $table->string('surgery_certificate')->nullable();
            $table->string('ref_id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('file_merge');
    }
}
