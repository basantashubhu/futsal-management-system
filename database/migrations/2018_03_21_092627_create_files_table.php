<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table');
            $table->index('table');
            $table->integer('table_id');
            $table->index('table_id');
            $table->string('document_segment');
            $table->string('document_title', 200);
            $table->longText('file_name');
            $table->string('status')->default('New');
            $table->date('expiry_date')->nullable();
            $table->integer('print_attempts')->default(0);
            $table->integer('send_attempts')->default(0);
            $table->text('document_type')->nullable();
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
        Schema::dropIfExists('files');
    }
}
