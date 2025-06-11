<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function getKategori()
    {
        $response = Http::get('https://dummyjson.com/products');

        if($response->successful()) {
            $kategori = $response->json();
            return response()->json($kategori); // Kirim data ke json
        }

        return response()->json(['error' => 'unable to fetch data'], 500);
    }

    public function index()
    {
        $data['result'] = \App\Models\kategori::all();
        return view('kategori/index')->with($data);
    }
}