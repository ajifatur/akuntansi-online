<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('package')) {
            Schema::create('package', function (Blueprint $table) {
                $table->bigIncrements('id_package');
                $table->string('package_name');
                $table->string('package_version');
                $table->timestamp('package_at')->nullable();
                $table->timestamp('package_up')->nullable();
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
        // Schema::dropIfExists('package');
    }
}
