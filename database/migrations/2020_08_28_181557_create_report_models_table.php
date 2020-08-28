<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_models', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('reportNumber');
            $table->string('reportOrderList');
            $table->string('reportIsDateRange');
            $table->string('reportIsSpecificOrders');
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
        Schema::dropIfExists('report_models');
    }
}
