<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom shipping_courier, shipping_service, dan shipping_cost ke tabel orders
     * Untuk menyimpan informasi pengiriman yang dipilih customer pada checkout
     * 
     * Kolom baru:
     * - shipping_courier: Kurir yang dipilih (jne, pos, tiki)
     * - shipping_service: Jenis layanan pengiriman (OKE, REG, SICEPAT, dll)
     * - shipping_cost: Biaya pengiriman yang dihitung oleh RajaOngkir (dalam Rupiah)
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_courier')->nullable()->after('status'); // Contoh: jne, pos, tiki
            $table->string('shipping_service')->nullable()->after('shipping_courier'); // Contoh: OKE, REG
            $table->decimal('shipping_cost', 10, 2)->nullable()->default(0)->after('shipping_service'); // Biaya pengiriman
        });
    }

    /**
     * Hapus kolom shipping_courier, shipping_service, dan shipping_cost
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['shipping_courier', 'shipping_service', 'shipping_cost']);
        });
    }
};
