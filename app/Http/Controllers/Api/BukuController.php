<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Author;


class BukuController extends Controller
{
    public function index(){
        $data = buku::select(
            "bukus.id",
            "bukus.judul_buku",
            "kategoris.nama_kategori",
            "authors.nama_author"
        )
        ->join("kategoris", "kategoris.id", "=", "bukus.id_kategori")
        ->join("authors", "authors.id", "=", "bukus.id_author")
        ->get();
        
        return response()->json([
            "status" => true,
            "message" => "data ditemukan",
            "data" => $data,
        ]);
    }

    public function show($id){
        
        $data['buku'] = $buku = buku::query()->where("id", $id)->first();
        $data['buku']['kategori'] = $kategori = Kategori::query()->where("id", $buku->id_kategori)->get();
        $data['buku']['author'] = $author = Author::query()->where("id", $buku->id_author)->get();

        if($buku == null){
            return response()->json([
                "status" => false,
                "message" => "buku tidak ditemukan",
                "data" => null
            ]);
        }
        return response()->json([
            "status" => true,
            "message" => "buku ditemukan",
            "data" => $data
        ]);
    }

    public function store(Request $request){
        $payload = $request->all();

        if(
            !isset($payload["judul_buku"]) || 
            !isset($payload["tahun_terbit"]) || 
            !isset($payload["penerbit_buku"]) || 
            !isset($payload["jumlah_halaman"]) ||
            !isset($payload["sinopsis_buku"]) ||
            !isset($payload["id_kategori"]) ||
            !isset($payload["id_author"])
        ) {
            return response()->json([
                "status" => false,
                "message" => "Form Kurang Lengkap",
                "data" => null
            ]);
        }

        $file = $request->file("gambar_cover");
        $filename = $file->hashName();
        $file->move("cover", $filename);
        $path = "/cover/" . $filename;

        $buku = buku::create([
            'gambar_cover' => $path,
            'judul_buku' => $request->judul_buku,
            'tahun_terbit' => $request->tahun_terbit,
            'penerbit_buku' => $request->penerbit_buku,
            'jumlah_halaman' => $request->jumlah_halaman,
            'sinopsis_buku' => $request->sinopsis_buku,
            'id_kategori' => $request->id_kategori,
            'id_author' => $request->id_author,
        ]);
        
        // $buku = buku::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $buku
        ]);
    }

    public function update(Request $request, $id){
        // Cek buku ada/tidak
        $buku = buku::find($id);
        if($buku == null){
            return response()->json([
                "status" => false,
                "message" => "buku tidak ditemukan",
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

        // kelola input file
        $file = $request->file("gambar_cover");
        $filename = $file->hashName();
        $file->move("cover", $filename);
        $path = "/cover/" . $filename;


        // Update DB
        $buku = buku::find($id);
        $buku->fill([
            'gambar_cover' => $path,
            'judul_buku' => $request->judul_buku,
            'tahun_terbit' => $request->tahun_terbit,
            'penerbit_buku' => $request->penerbit_buku,
            'jumlah_halaman' => $request->jumlah_halaman,
            'sinopsis_buku' => $request->sinopsis_buku,
            'id_kategori' => $request->id_kategori,
            'id_author' => $request->id_author,
        ]);
        $buku->save();

        return response()->json([
            "status" => true,
            "message" => "data berhasil di update",
            "data" => $buku
        ]);
    }

    public function destroy($id){
        $buku = buku::query()->where("id", $id)->first();
        if($buku == null){
            return response()->json([
                "status" => false,
                "message" => "buku tidak ditemukan",
                "data" => null
            ]);
        }

        $buku->delete();
        return response()->json([
            "status" => true,
            "message" => "Data Berhasil Dihapus"
        ]);
    }
}
