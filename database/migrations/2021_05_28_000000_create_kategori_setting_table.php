<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('kategori_setting')) {
            Schema::create('kategori_setting', function (Blueprint $table) {
                $table->bigIncrements('id_ks');
                $table->string('kategori');
                $table->string('slug');
                $table->string('prefix');
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
        // Schema::dropIfExists('kategori_setting');
    }
}
