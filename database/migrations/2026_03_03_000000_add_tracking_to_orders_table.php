<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * We'll add latitude and longitude columns to orders so that delivery
     * personnel can update the current GPS coordinates for real-time tracking.
     * The columns are nullable since an order won't have a location until
     * it's handed off to a driver.
     *
     * @return void
     */
  public function up()
{
    Schema::table('orders', function (Blueprint $table) {

        if (!Schema::hasColumn('orders', 'latitude')) {
            $table->decimal('latitude', 10, 7)->nullable();
        }

        if (!Schema::hasColumn('orders', 'longitude')) {
            $table->decimal('longitude', 10, 7)->nullable();
        }

    });
}

public function down(){
    Schema::table('orders', function (Blueprint $table) {
        if (Schema::hasColumn('orders', 'latitude')) {
            $table->dropColumn('latitude');
        }

        if (Schema::hasColumn('orders', 'longitude')) {
            $table->dropColumn('longitude');
        }

    });
}
};
