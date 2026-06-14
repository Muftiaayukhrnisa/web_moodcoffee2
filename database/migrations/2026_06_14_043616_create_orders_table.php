<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('order_number')->unique();
            $table->enum('order_type', ['dine_in', 'take_away']);
            $table->enum('payment_method', ['qris', 'cashier']);
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->enum('order_status', ['new', 'processing', 'completed', 'cancelled'])->default('new');
            $table->decimal('total_amount', 12, 2);
            $table->string('qrcode_payment_token')->nullable();
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('orders'); }
};