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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Misal: IT, HR, Finance
            $table->string('location'); // Misal: Lantai 1, Gedung B
            $table->timestamps();
        });

        // Seed data dummy biar langsung bisa dipakai
        DB::table('departments')->insert([
            ['name' => 'IT Development', 'location' => 'Lantai 3'],
            ['name' => 'Human Resources', 'location' => 'Lantai 1'],
            ['name' => 'Finance', 'location' => 'Lantai 2'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
