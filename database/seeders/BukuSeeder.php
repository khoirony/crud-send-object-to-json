<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buku::query()->create([
            "judul_buku" => "Harry Potter and the Sorcerer's Stone",
            "tahun_terbit" => "1997",
            "penerbit_buku" => "Bloomsbury",
            "jumlah_halaman" => 223,
            "sinopsis_buku" => "Harry Potter is a young wizard who discovers his true identity and the dark past of his parents.",
            "gambar_cover" => "/cover/gambar1.jpg",
            "id_author" => 1,
            "id_kategori" => 1,
        ]);
        Buku::query()->create([
            "judul_buku" => "The Catcher in the Rye",
            "tahun_terbit" => "1951",
            "penerbit_buku" => "Little, Brown and Company",
            "jumlah_halaman" => 277,
            "sinopsis_buku" => "Holden Caulfield, a young man, tells the story of a couple of days in his life, just after he's been expelled from prep school.",
            "gambar_cover" => "/cover/gambar2.jpg",
            "id_author" => 2,
            "id_kategori" => 2,
        ]);
        Buku::query()->create([
            "judul_buku" => "Pride and Prejudice",
            "tahun_terbit" => "1813",
            "penerbit_buku" => "T. Egerton",
            "jumlah_halaman" => 279,
            "sinopsis_buku" => "Pride and Prejudice is a novel of manners by Jane Austen, first published in 1813. The story follows the main character, Elizabeth Bennet, as she deals with issues of manners, upbringing, morality, education, and marriage in the society of the landed gentry of the British Regency.",
            "gambar_cover" => "/cover/gambar3.jpg",
            "id_author" => 3,
            "id_kategori" => 3,
        ]);
        Buku::query()->create([
            "judul_buku" => "To Kill a Mockingbird",
            "tahun_terbit" => "1960",
            "penerbit_buku" => "Lippincott & Co.",
            "jumlah_halaman" => 281,
            "sinopsis_buku" => "To Kill a Mockingbird is a novel by Harper Lee published in 1960. It is a coming-of-age story about a young girl, Scout Finch, and her brother Jem, who are raised by their father and mother in the fictional town of Maycomb, Alabama.",
            "gambar_cover" => "/cover/gambar4.jpg",
            "id_author" => 4,
            "id_kategori" => 2,
        ]);
        Buku::query()->create([
            "judul_buku" => "The Great Gatsby",
            "tahun_terbit" => "1925",
            "penerbit_buku" => "Charles Scribner's Sons",
            "jumlah_halaman" => 180,
            "sinopsis_buku" => "The Great Gatsby is a novel by F. Scott Fitzgerald, first published in 1925. The story takes place in the summer of 1922 and follows the life of Nick Carraway, a young man from the Midwest who becomes drawn into the world of his mysterious neighbor, Jay Gatsby.",
            "gambar_cover" => "/cover/gambar.jpg",
            "id_author" => 5,
            "id_kategori" => 3,
        ]);
    }
}
