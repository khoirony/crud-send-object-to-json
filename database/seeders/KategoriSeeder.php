<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::query()->create([
            "nama_kategori" => "Fantasy",
            "deskripsi_kategori" => "Ini kategori Fantasy",
        ]);
        Kategori::query()->create([
            "nama_kategori" => "Classic",
            "deskripsi_kategori" => "Ini kategori Classic",
        ]);
        Kategori::query()->create([
            "nama_kategori" => "Romance",
            "deskripsi_kategori" => "Ini kategori Romance",
        ]);
    }
}
