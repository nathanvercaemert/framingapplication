<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMouldingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mouldings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('mouldingNumber');
            $table->string('mouldingVendor');
            $table->string('mouldingPrice');
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
        Schema::dropIfExists('mouldings');
    }
}
