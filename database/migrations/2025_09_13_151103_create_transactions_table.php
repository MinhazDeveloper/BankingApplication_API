<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('transfer_id')->nullable(); // কোনো transfer এর সাথে লিঙ্কড থাকলে

            $table->decimal('amount', 16, 4);
            $table->decimal('balance', 16, 4);

            $table->string('category')->nullable(); // যেমন: deposit, withdrawal, transfer ইত্যাদি
            $table->boolean('confirmed')->default('0');
            $table->string('description')->nullable();
            $table->dateTime('date');
            $table->text('metal')->nullable();
            $table->timestamps();

            // foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('transfer_id')->references('id')->on('transactions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
