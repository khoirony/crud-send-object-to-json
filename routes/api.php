<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\KategoriController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Api CRUD buku
Route::get("/buku/list", [BukuController::class, 'index']);
Route::get("/buku/{id}", [BukuController::class, 'show']);
Route::post("/buku", [BukuController::class, 'store']);
Route::post("/buku/{id}/update", [BukuController::class, 'update']);
Route::post("/buku/{id}/delete", [BukuController::class, 'destroy']);

// Api CRUD Author
Route::get("/author/list", [AuthorController::class, 'index']);
Route::get("/author/{id}", [AuthorController::class, 'show']);
Route::post("/author", [AuthorController::class, 'store']);
Route::post("/author/{id}/update", [AuthorController::class, 'update']);
Route::post("/author/{id}/delete", [AuthorController::class, 'destroy']);

// Api CRUD Kategori
Route::get("/kategori/list", [KategoriController::class, 'index']);
Route::get("/kategori/{id}", [KategoriController::class, 'show']);
Route::post("/kategori", [KategoriController::class, 'store']);
Route::post("/kategori/{id}/update", [KategoriController::class, 'update']);
Route::post("/kategori/{id}/delete", [KategoriController::class, 'destroy']);