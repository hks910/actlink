<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('system_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entityName', 255);
            $table->string('entityOperation', 255);
            $table->string('operationDescription', 255)->nullable();
            $table->timestamp('datetime')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('systemLog');
    }
};
