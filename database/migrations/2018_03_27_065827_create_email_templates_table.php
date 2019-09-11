<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTemplatesTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('section')->nullable();
            $table->string('temp_type')->nullable();
            $table->string('temp_name');
            $table->index('temp_name');
            $table->string('temp_code');
            $table->longText('temp_html')->nullable();
            $table->longText('temp_json')->nullable();
            $table->longText('temp_instruction')->nullable();
            $table->boolean('is_default')->default(false);
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
        Schema::dropIfExists('email_templates');
    }
}
