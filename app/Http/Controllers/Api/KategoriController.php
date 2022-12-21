<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Author;

class KategoriController extends Controller
{
    public function index(){
        $data = Kategori::query()->get();
        
        return response()->json([
            "status" => true,
            "message" => "data ditemukan",
            "data" => $data,
        ]);
    }

    public function show($id){
        $kategori = Kategori::query()->where("id", $id)->first();
        $buku = Buku::select(
            "bukus.id",
            "bukus.judul_buku",
            "bukus.tahun_terbit",
            "bukus.penerbit_buku",
            "bukus.jumlah_halaman",
            "bukus.sinopsis_buku",
            "bukus.gambar_cover",
            "authors.nama_author",
        )->where("id_kategori", $kategori->id)
        ->join("kategoris", "kategoris.id", "=", "bukus.id_kategori")
        ->join("authors", "authors.id", "=", "bukus.id_author")
        ->get();

        $data['kategori'] = $kategori;
        $data['kategori']['buku'] = $buku;

        if($kategori == null){
            return response()->json([
                "status" => false,
                "message" => "kategori tidak ditemukan",
                "data" => null
            ]);
        }
        return response()->json([
            "status" => true,
            "message" => "kategori ditemukan",
            "data" => $data
        ]);
    }

    public function store(Request $request){
        $payload = $request->all();

        if(
            !isset($payload["nama_kategori"]) || 
            !isset($payload["deskripsi_kategori"])
        ) {
            return response()->json([
                "status" => false,
                "message" => "Form Kurang Lengkap",
                "data" => null
            ]);
        }

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi_kategori' => $request->deskripsi_kategori,
        ]);
        
        // $kategori = kategori::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "data kategori berhasil ditambahkan",
            "data" => $kategori
        ]);
    }

    public function update(Request $request, $id){
        // Cek kategori ada/tidak
        $kategori = Kategori::find($id);
        if($kategori == null){
            return response()->json([
                "status" => false,
                "message" => "kategori tidak ditemukan",
                "data" => null
            ]);
        }

        // Cek Perubahan
        $payload = $request->all();
        if(!isset($payload)){
            return response()->json([
                "status" => false,
                "message" => "Tidak Ada Perubahan",
                "data" => null
            ]);
        }

        // Update DB
        $kategori = Kategori::find($id);
        $kategori->fill([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi_kategori' => $request->deskripsi_kategori,
        ]);
        $kategori->save();

        return response()->json([
            "status" => true,
            "message" => "data kategori berhasil di update",
            "data" => $kategori
        ]);
    }

    public function destroy($id){
        $kategori = kategori::query()->where("id", $id)->first();
        if($kategori == null){
            return response()->json([
                "status" => false,
                "message" => "kategori tidak ditemukan",
                "data" => null
            ]);
        }

        $kategori->delete();
        return response()->json([
            "status" => true,
            "message" => "Data Kategori Berhasil Dihapus"
        ]);
    }
}
