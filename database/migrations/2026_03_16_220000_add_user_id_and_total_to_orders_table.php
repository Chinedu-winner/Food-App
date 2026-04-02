<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
     Schema::table('orders', function (Blueprint $table) {
    if (!Schema::hasColumn('orders', 'user_id')) {
        $table->foreignId('user_id');
    }
    if (!Schema::hasColumn('orders', 'total_price')) {
        $table->decimal('total_price', 8, 2)->default(0);
    }
});
    }

    public function down(): void {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'user_id')) {
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('orders', 'total')) {
                $table->dropColumn('total');
            }
        });
    }
};