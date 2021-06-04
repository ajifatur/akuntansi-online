<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->bigIncrements('id_setting');
                $table->string('setting_name');
                $table->integer('setting_category');
                $table->text('setting_rules');
                $table->string('setting_key');
                $table->text('setting_value');
                $table->integer('setting_order');
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
        // Schema::dropIfExists('settings');
    }
}
