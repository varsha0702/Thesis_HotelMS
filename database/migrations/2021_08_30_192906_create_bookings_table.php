<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')
            ->references('id')->on('rooms');
            $table->foreignId('customer_id')
            ->references('id')->on('users')->onDelete('cascade');;
            $table->string('checkin_date');
            $table->string('checkout_date');
            $table->string('total_adults');
            $table->string('total_children')->nullable();
            $table->string('ref');
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
        Schema::dropIfExists('bookings');
    }
}
