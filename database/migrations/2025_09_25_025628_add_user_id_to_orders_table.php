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
        Schema::table('orders', function (Blueprint $table) {
            // Tambahkan kolom user_id setelah kolom 'id'
            // constrained() akan otomatis membuat foreign key ke tabel 'users'
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Ini untuk jaga-jaga jika perlu rollback migrasi
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};