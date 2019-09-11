<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name')->nullable();
            $table->unsignedInteger('table_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('to')->nullable()->index();
            $table->text('message')->nullable();
            $table->string('type')->nullable();
            $table->string('url')->nullable();
            $table->longText('payload')->nullable();
            $table->dateTime('read_at')->nullable();
            $table->boolean('is_read')->default(false);
            $table->ipAddress('read_ip')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
