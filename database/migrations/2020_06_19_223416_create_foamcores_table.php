<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoamcoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foamcores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('foamcoreType');
            $table->string('foamcoreVendor');
            $table->string('foamcorePrice');
            $table->string('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foamcores');
    }
}
