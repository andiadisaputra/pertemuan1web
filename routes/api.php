<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// GET - Daftar mahasiswa
Route::get('/mahasiswa', function () {
    $data = [
        ['id' => 1, 'nama' => 'Andi Adi Saputra',   'jurusan' => 'Informatika'],
        ['id' => 2, 'nama' => 'Budi Santoso',    'jurusan' => 'Sistem Informasi'],
        ['id' => 3, 'nama' => 'Citra Dewi',      'jurusan' => 'Teknik Komputer'],
    ];
    return response()->json([
        'status'  => 'success',
        'message' => 'Data mahasiswa berhasil diambil',
        'data'    => $data,
    ], 200);
});

// GET - Detail mahasiswa berdasarkan ID
Route::get('/mahasiswa/{id}', function ($id) {
    return response()->json([
        'status'  => 'success',
        'message' => "Detail mahasiswa ID: $id",
        'data'    => [
            'id'      => (int)$id,
            'nama'    => 'Andi Saputra',
            'jurusan' => 'Informatika',
            'angkatan'=> 2022,
        ],
    ], 200);
});

// POST - Tambah mahasiswa
Route::post('/mahasiswa', function (Request $request) {
    return response()->json([
        'status'  => 'success',
        'message' => 'Mahasiswa berhasil ditambahkan',
        'data'    => [
            'id'      => rand(10, 99),
            'nama'    => $request->nama,
            'jurusan' => $request->jurusan,
        ],
    ], 200);
});