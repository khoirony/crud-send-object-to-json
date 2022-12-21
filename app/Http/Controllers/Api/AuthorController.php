<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index(){
        $data = Author::query()->get();
        
        return response()->json([
            "status" => true,
            "message" => "data ditemukan",
            "data" => $data,
        ]);
    }

    public function show($id){
        $author = Author::query()->where("id", $id)->first();
        $buku = Buku::select(
            "bukus.id",
            "bukus.judul_buku",
            "bukus.tahun_terbit",
            "bukus.penerbit_buku",
            "bukus.jumlah_halaman",
            "bukus.sinopsis_buku",
            "bukus.gambar_cover",
            "kategoris.nama_kategori",
        )->where("id_author", $author->id)
        ->join("kategoris", "kategoris.id", "=", "bukus.id_kategori")
        ->join("authors", "authors.id", "=", "bukus.id_author")
        ->get();

        $data['author'] = $author;
        $data['author']['buku'] = $buku;

        if($author == null){
            return response()->json([
                "status" => false,
                "message" => "author tidak ditemukan",
                "data" => null
            ]);
        }
        return response()->json([
            "status" => true,
            "message" => "author ditemukan",
            "data" => $data
        ]);
    }

    public function store(Request $request){
        $payload = $request->all();

        if(
            !isset($payload["nama_author"]) || 
            !isset($payload["jenis_kelamin"]) || 
            !isset($payload["tanggal_lahir"]) || 
            !isset($payload["negara_asal"]) ||
            !isset($payload["biografi"])
        ) {
            return response()->json([
                "status" => false,
                "message" => "Form Kurang Lengkap",
                "data" => null
            ]);
        }

        $file = $request->file("foto_author");
        $filename = $file->hashName();
        $file->move("foto", $filename);
        $path = "/foto/" . $filename;

        $author = author::create([
            'foto_author' => $path,
            'nama_author' => $request->nama_author,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'negara_asal' => $request->negara_asal,
            'biografi' => $request->biografi,
        ]);
        
        // $author = author::query()->create($payload);
        return response()->json([
            "status" => true,
            "message" => "",
            "data" => $author
        ]);
    }

    public function update(Request $request, $id){
        // Cek author ada/tidak
        $author = Author::find($id);
        if($author == null){
            return response()->json([
                "status" => false,
                "message" => "author tidak ditemukan",
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
        $file = $request->file("foto_author");
        $filename = $file->hashName();
        $file->move("foto", $filename);
        $path = "/foto/" . $filename;


        // Update DB
        $author = author::find($id);
        $author->fill([
            'foto_author' => $path,
            'nama_author' => $request->nama_author,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'negara_asal' => $request->negara_asal,
            'biografi' => $request->biografi,
        ]);
        $author->save();

        return response()->json([
            "status" => true,
            "message" => "data berhasil di update",
            "data" => $author
        ]);
    }

    public function destroy($id){
        $author = author::query()->where("id", $id)->first();
        if($author == null){
            return response()->json([
                "status" => false,
                "message" => "author tidak ditemukan",
                "data" => null
            ]);
        }

        $author->delete();
        return response()->json([
            "status" => true,
            "message" => "Data Berhasil Dihapus"
        ]);
    }
}
