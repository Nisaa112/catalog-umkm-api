<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data = kategori::get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = kategori::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil Ditambahkan',
            'data' => $data
        ]);
    }

    public function show(string $id)
    {
        $data = kategori::find($id);
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
    
    public function update(Request $request, string $id)
    {
        $data = kategori::find($id);
        $data->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Update berhasil',
            'data' => $data
        ], 200);
    }

    public function destroy(string $id)
    {
        $data = kategori::find($id);
        $data->delete();
        return response()->json([
            'status' => true,
            'message' => 'Update berhasil',
        ], 200);
    }

}