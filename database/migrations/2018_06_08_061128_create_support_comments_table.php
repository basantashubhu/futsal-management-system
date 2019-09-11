<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportCommentsTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('support_id');
            $table->unsignedInteger('comment_id')->nullable();
            $table->foreign('support_id')->references('id')->on('supports')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('comment_id')->references('id')->on('support_comments')->onUpdate('cascade')->onDelete('restrict');
            $table->longText('comment')->nullable();
            $table->boolean('is_correct')->default(false);
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
        Schema::dropIfExists('support_comments');
    }
}
