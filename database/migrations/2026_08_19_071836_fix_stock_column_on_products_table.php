<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Pastikan kolom stock tersedia
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('products', 'stock')) {

            Schema::table('products', function (Blueprint $table) {
                $table->unsignedInteger('stock')
                    ->default(0)
                    ->after('selling_price');
            });

        } else {

            /*
            |--------------------------------------------------------------------------
            | Jika kolom stock sudah ada, paksa default menjadi 0
            |--------------------------------------------------------------------------
            */

            DB::statement(
                'ALTER TABLE products
                 MODIFY stock INT UNSIGNED NOT NULL DEFAULT 0'
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Jangan hapus kolom jika sudah digunakan aplikasi
        |--------------------------------------------------------------------------
        */

        // Sengaja tidak menghapus kolom stock.
    }
};