<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('transaction_date');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->string('buyer_name');
            $table->string('buyer_email');
            $table->string('buyer_phone');
            $table->timestamps();
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
