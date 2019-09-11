<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginuserTable extends Migration
{
    use \App\Lib\Database\DefaultsFields;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loginuser', function (Blueprint $table) {
            $table->increments('id')->index()->unique();
            $table->string('usrlogin')->unique()->index();

            $table->tinyInteger('active_flag')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_addr1')->nullable()->index();
            $table->unsignedInteger('user_addr2')->nullable()->index();
            $table->dateTime('user_city')->nullable();
            $table->unsignedInteger('user_state')->nullable();
            $table->string('user_zip')->nullable();
            $table->string('user_county')->nullable();
            $table->string('user_ctry')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_telno')->nullable();
            $table->string('user_cellno')->nullable();
            $table->string('user_fax')->nullable();
            $table->string('user_level')->nullable();
            $table->string('user_id_type')->nullable();
            $table->string('user_id_image')->nullable();
            $table->string('user_sig')->nullable();
            $table->tinyInteger('logged_in')->nullable();
            $table->dateTime('logindate')->nullable();
            $table->unsignedInteger('logintime')->nullable();
            $table->unsignedInteger('time_zone')->nullable();
            $table->string('future1')->nullable();
            $table->unsignedInteger('cust_no')->nullable();
            $table->string('dflt_group')->nullable();
            $table->dateTime('pwddate')->nullable();
            $table->unsignedInteger('pwdtime')->nullable();
            $table->string('login_email')->nullable();
            $table->string('email_pwd')->nullable();
            $table->string('login_ip')->nullable();
            $table->string('login_os')->nullable();
            $table->string('login_browser')->nullable();
            $table->string('session_id')->nullable();
            $table->string('login_source')->nullable();
            $table->string('user_ext')->nullable();
            $table->string('user_social1')->nullable();
            $table->string('user_social2')->nullable();
            $table->string('user_social3')->nullable();
            $table->string('api_key')->nullable();
            $table->string('user_title')->nullable();
            $table->string('user_signame')->nullable();
            $table->string('user_coname')->nullable();
            $table->string('logo_file')->nullable();
            $table->string('email_host')->nullable();
            $table->string('email_port')->nullable();
            $table->tinyInteger('email_auth')->nullable();
            $table->string('user_dept')->nullable();
            $table->string('dflt_mgr')->nullable();
            $table->string('allow_perms')->nullable();
            
            $table->unsignedInteger('audit_key')->nullable();

            $this->defaultsFieldsNew($table);
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
        Schema::dropIfExists('loginuser');
    }
}
