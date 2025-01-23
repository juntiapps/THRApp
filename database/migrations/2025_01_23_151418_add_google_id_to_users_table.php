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
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique()->after('password'); // Menambahkan kolom google_id setelah password
            $table->string('avatar')->nullable()->after('google_id'); // Contoh menambahkan kolom avatar
            // Jika ingin menambahkan kolom lain seperti google_token, bisa ditambahkan disini
            // $table->text('google_token')->nullable()->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('google_id');
            $table->dropColumn('avatar');
            // Jika menambahkan kolom lain di up(), maka harus di drop juga disini
            // $table->dropColumn('google_token');
        });
    }
};