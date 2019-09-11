<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('preg_no')->nullable()->index();
            $table->unsignedInteger('period_id')->nullable()->index();
            $table->dateTime('note_date')->nullable()->index();
            $table->string('vol_id')->index();
            $table->string('note_code')->nullable();
            $table->string('note_type')->nullable()->index();
            $table->tinyInteger('note_done')->nullable();
            $table->string('note_user')->nullable();
            $table->string('note_desc')->nullable();
            $table->string('site_id')->nullable()->index();
            $table->string('attachfile')->nullable();
            $table->unsignedInteger('volhours_link_id')->nullable()->index();
            $table->tinyInteger('auto_created')->nullable();
            $table->string('reccode')->nullable();
            $table->string('sort_name')->nullable()->index();
            $table->unsignedInteger('audit_key')->nullable();
            $table->datetime('start')->nullable();
            $table->datetime('end')->nullable();
            $table->string('priority')->nullable();
            $table->string('activity')->nullable();
            $table->boolean('is_notification')->default(false);
            $table->string('url')->nullable();
            $table->boolean('is_seen')->default(false);
            $table->boolean('is_completed')->default(false);
            $table->dateTime('seen_date')->nullable();
            $table->string('title', 500)->nullable();
            $table->string('status')->nullable();
            $table->dateTime('reminder_timestamp')->nullable();
            $table->dateTime('todo_timestamp')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $this->defaultsFieldsNew($table);
            $table->timestamps();
        });
    }
    /*
     *   $table->string('type')->default('default');
                $table->string('url')->nullable();
                $table->string('className')->nullable();
                $table->text('description')->nullable();
                $table->datetime('start')->nullable();
                $table->datetime('end')->nullable();
                $table->boolean('is_public')->default(false);
                $table->unsignedInteger('user_id');*/
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
