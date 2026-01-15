<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Kelas (misal: XII IPA 1)
            $table->string('teacher'); // Wali Kelas
            $table->timestamps();
        });

        // Kita isi data dummy kelas di sini biar praktis
        DB::table('classrooms')->insert([
            ['name' => 'X RPL 1', 'teacher' => 'Pak Budi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'XI TKJ 2', 'teacher' => 'Bu Susi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'XII DKV 3', 'teacher' => 'Pak Joko', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
