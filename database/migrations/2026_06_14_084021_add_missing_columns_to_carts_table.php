<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Cek apakah kolom size ada, jika tidak tambahkan
        if (!Schema::hasColumn('carts', 'size')) {
            Schema::table('carts', function (Blueprint $table) {
                $table->string('size')->nullable();
            });
        }

        // Cek apakah kolom milk ada
        if (!Schema::hasColumn('carts', 'milk')) {
            Schema::table('carts', function (Blueprint $table) {
                $table->string('milk')->nullable();
            });
        }

        // Cek apakah kolom unit_price ada
        if (!Schema::hasColumn('carts', 'unit_price')) {
            Schema::table('carts', function (Blueprint $table) {
                $table->decimal('unit_price', 10, 2)->nullable();
            });
        }
    }

    public function down()
    {
        // Hapus kolom jika ada (opsional)
        Schema::table('carts', function (Blueprint $table) {
            if (Schema::hasColumn('carts', 'size')) $table->dropColumn('size');
            if (Schema::hasColumn('carts', 'milk')) $table->dropColumn('milk');
            if (Schema::hasColumn('carts', 'unit_price')) $table->dropColumn('unit_price');
        });
    }
};