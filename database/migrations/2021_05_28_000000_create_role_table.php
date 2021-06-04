<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('role')) {
            Schema::create('role', function (Blueprint $table) {
                $table->bigIncrements('id_role');
                $table->string('key_role');
                $table->string('nama_role');
                $table->integer('is_admin');
                $table->timestamp('role_at')->nullable();
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
        // Schema::dropIfExists('role');
    }
}
