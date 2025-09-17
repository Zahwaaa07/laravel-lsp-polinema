<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seeder kategori surat default
        DB::table('kategoris')->insert([
            ['id' => 1, 'nama_kategori' => 'Undangan', 'keterangan' => 'Surat undangan'],
            ['id' => 2, 'nama_kategori' => 'Pengumuman', 'keterangan' => 'Surat pengumuman'],
            ['id' => 3, 'nama_kategori' => 'Nota Dinas', 'keterangan' => 'Surat nota dinas'],
            ['id' => 4, 'nama_kategori' => 'Pemberitahuan', 'keterangan' => 'Surat pemberitahuan'],
        ]);
    }
}
