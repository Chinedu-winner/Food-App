<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->string('phone')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 8, 2)->default(0);
            $table->string('phone')->nullable(); 
            $table->string('address')->nullable(); 
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->enum('status', ['pending','processing','completed','canceled'])->default('pending');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down(): void {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('foods');
    }
};