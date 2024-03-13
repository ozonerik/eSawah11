<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appconfigs', function (Blueprint $table) {
            $table->id();
            $table->string('mapapikey');
            $table->bigInteger('hargapadi');
            $table->integer('nilailanja');
            $table->bigInteger('hargabata');
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
        Schema::dropIfExists('appconfigs');
    }
};
