<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notes')->insert([
            'title' => 'Catatan Harian Ku',
            'desc' => 'semua kegiatan harianku ada di notes ini',
            'text' => '<p>halo semua ini catatan dari kegiatanku</p>',
        ]);
    }
}
