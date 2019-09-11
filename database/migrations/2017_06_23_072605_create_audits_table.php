<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Lib\Database\DefaultsFields;

class CreateAuditsTable extends Migration
{
    use DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name');
            $table->unsignedInteger('table_id');
            $table->longText('old_record');
            $table->longText('new_record');
            $table->integer('user_id');
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
        Schema::dropIfExists('audits');
    }
}
