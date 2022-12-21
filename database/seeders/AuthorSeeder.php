<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;


class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::query()->create([
            "nama_author" => "J.K. Rowling",
            "jenis_kelamin" => "Perempuan",
            "tanggal_lahir" => "1997-08-03",
            "negara_asal" => "UK",
            "biografi" => "pengarang",
            "foto_author" => "/foto/foto1.jpg",
        ]);
        Author::query()->create([
            "nama_author" => "J.D. Salinger",
            "jenis_kelamin" => "Perempuan",
            "tanggal_lahir" => "1997-08-03",
            "negara_asal" => "US",
            "biografi" => "0837475673",
            "foto_author" => "/foto/foto2.jpg",
        ]);
        Author::query()->create([
            "nama_author" => "Jane Austen",
            "jenis_kelamin" => "Perempuan",
            "tanggal_lahir" => "1997-08-03",
            "negara_asal" => "UK",
            "biografi" => "0837475673",
            "foto_author" => "/foto/foto3.jpg",
        ]);
        Author::query()->create([
            "nama_author" => "Harper Lee",
            "jenis_kelamin" => "Perempuan",
            "tanggal_lahir" => "1997-08-03",
            "negara_asal" => "UK",
            "biografi" => "0837475673",
            "foto_author" => "/foto/foto4.jpg",
        ]);
        Author::query()->create([
            "nama_author" => "F. Scott Fitzgerald",
            "jenis_kelamin" => "Perempuan",
            "tanggal_lahir" => "1997-08-03",
            "negara_asal" => "US",
            "biografi" => "0837475673",
            "foto_author" => "/foto/foto5.jpg",
        ]);
    }
}
