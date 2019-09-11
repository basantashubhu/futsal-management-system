<?php


namespace App\Lib\Database;


trait DefaultsFields
{
    public function defaultsFields($table)
    {
        $table->unsignedInteger('co_no')->default(1);
        $table->boolean('is_deleted')->default(0);
        $table->boolean('is_active')->default(1);
        $table->integer('userc_id')->default(0);
        $table->integer('useru_id')->nullable();
        $table->integer('userd_id')->nullable();
        $table->timestamp('deleted_at')->nullable();
    }

    public function defaultFieldsDown($table)
    {
        $table->dropColumn('co_no');
        $table->dropColumn('is_deleted');
        $table->dropColumn('is_active');
        $table->dropColumn('userc_id');
        $table->dropColumn('useru_id');
        $table->dropColumn('userd_id');
        $table->dropColumn('deleted_at');
    }

    public function defaultsFieldsNew($table)
    {
        $table->boolean('is_deleted')->default(0);
        $table->boolean('is_active')->default(1);
        $table->unsignedInteger('userc_id')->nullable();
        $table->string('userc_date')->nullable()->index();
        $table->string('userc_time')->nullable();
        $table->unsignedInteger('useru_id')->nullable();
        $table->date('useru_date')->nullable();
        $table->string('useru_time')->nullable();
        $table->bigInteger('progress_recid')->nullable()->index();
        $table->bigInteger('progress_recid_ident')->nullable()->index()->unique();
    }

}