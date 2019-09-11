<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table')->nullable();
            $table->integer('table_id')->nullable();
            $table->string('code')->nullable();
            $table->string('terms_type')->nullable();
            $table->string('terms_title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('instruction')->nullable();
            $table->string('client_signed_by')->nullable();
            $table->string('client_signed_title')->nullable();
            $table->string('client_signature')->nullable();
            $table->string('client_signature_date')->nullable();
            $table->string('signed_by')->nullable();
            $table->string('signed_title')->nullable();
            $table->string('signature')->nullable();
            $table->string('signature_date')->nullable();
            $table->longText('options')->nullable();
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
        Schema::dropIfExists('terms');
    }
}
