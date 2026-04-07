<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'email_notifications')) {
            $table->boolean('email_notifications')->default(true);
        }

        if (!Schema::hasColumn('users', 'sms_notifications')) {
            $table->boolean('sms_notifications')->default(true);
        }

        if (!Schema::hasColumn('users', 'phone')) {
            $table->string('phone')->nullable();
        }

        if (!Schema::hasColumn('users', 'phone_verified')) {
            $table->boolean('phone_verified')->default(false);
        }

        if (!Schema::hasColumn('users', 'email_verified')) {
            $table->boolean('email_verified')->default(false);
        }
    });
}

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'email_notifications',
                'sms_notifications',
                'phone',
                'phone_verified',
                'email_verified'
            ]);
        });
    }
};
