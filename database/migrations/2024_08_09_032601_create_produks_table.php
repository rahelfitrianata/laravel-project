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
        Schema::create('produk1', function (Blueprint $table) {
            $table->id('idproduk');
            $table->string('namaproduk');
            $table->integer('stokproduk');
            $table->decimal('hargaproduk', 8, 2);
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk1', function (Blueprint $table) {
            $table->dropColumn('created_at');
        });
    }
};
