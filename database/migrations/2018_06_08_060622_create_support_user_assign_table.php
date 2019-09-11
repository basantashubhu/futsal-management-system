<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportUserAssignTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('support_id');
            $table->foreign('support_id')->references('id')->on('supports')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedInteger('assigned_to');
            $table->unsignedInteger('assigned_from')->nullable();
            $table->foreign('assigned_to')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('assigned_from')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->dateTime('assigned_date');
            $table->dateTime('end_date')->nullable();
            $table->boolean('is_correct')->default(0);
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
        Schema::dropIfExists('support_user');
    }
}
