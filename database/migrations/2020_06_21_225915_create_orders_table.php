<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();
            $table->string('isCompleted');
            $table->string('user');
            $table->string('orderNumber');
            $table->string('isReported');
            $table->string('reportNumber');
            $table->string('customerFirst');
            $table->string('customerLast');
            $table->string('customerEmail');
            $table->string('customerPhoneArea');
            $table->string('customerPhone3');
            $table->string('customerPhone4');
            $table->string('orderMouldingNumber');
            $table->string('orderGlassType');
            $table->string('orderFoamcoreType');
            $table->string('orderType');
            $table->string('orderWidth');
            $table->string('orderHeight');
            $table->string('orderFirstMatNumber');
            $table->string('orderSecondMatNumber');
            $table->string('orderThirdMatNumber');
            $table->string('orderPrice');
            $table->text('orderNotes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
