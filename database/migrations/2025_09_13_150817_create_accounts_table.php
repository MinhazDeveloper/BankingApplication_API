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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // foreign key reference
            $table->string('account_number')->unique();
            $table->decimal('balance', 16, 4)->default(0); // অর্থ রাখার জন্য, 15 digit + 2 decimal
            $table->boolean('blocked')->default(false); // account ব্লক করা হলে true
            // foreign key relation
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
