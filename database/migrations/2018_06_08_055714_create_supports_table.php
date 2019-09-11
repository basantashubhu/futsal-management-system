<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportsTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->unsignedInteger('project_id')->nullable();
            $table->string('version')->default('1');
            $table->string('support_type')->index();
            $table->string('support_category')->nullable();
            $table->string('support_department');
            $table->text('title');
            $table->longText('description')->nullable();
            $table->unsignedInteger('owner_id')->index();
            $table->string('status')->index();
            $table->text('conclusion')->nullable();
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
        Schema::dropIfExists('supports');
    }
}
