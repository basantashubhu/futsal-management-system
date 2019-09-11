<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alt_id',30)->nullable();
            $table->string('particulars');
            $table->string('table_name')->nullable();
            $table->unsignedInteger('table_id')->nullable();
            $table->string('ref_type')->nullable();
            $table->string('ref_no')->nullable();
            $table->string('type')->nullable();
            $table->double('dr_amount')->default(0.00);
            $table->double('cr_amount')->default(0.00);
            $table->date('budget_date');
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
        Schema::dropIfExists('budget');
    }
}
