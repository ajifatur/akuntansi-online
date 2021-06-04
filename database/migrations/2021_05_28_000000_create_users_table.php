<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->bigIncrements('id_user');
                $table->string('nama_user');
                $table->string('username');
                $table->string('email');
                $table->string('password');
                $table->date('tanggal_lahir')->nullable();
                $table->string('jenis_kelamin',1);
                $table->string('nomor_hp',20);
                $table->string('foto')->nullable();
                $table->integer('role');
                $table->integer('is_admin');
                $table->integer('status');
                $table->integer('email_verified');
                $table->timestamp('last_visit')->nullable();
                $table->timestamp('register_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('users');
    }
}
