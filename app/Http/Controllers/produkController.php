<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    public function getProduk()
    {
        $response = Http::get('https://dummyjson.com/products');

        if($response->successful()) {
            $produk = $response->json();
            return response()->json($produk); // Kirim data ke json
        }

        return response()->json(['error' => 'unable to fetch data'], 500);
    }

    public function index()
    {
        $data['result'] = \App\Models\produk::all();
        return view('produk/index')->with($data);
    }

    public function create()
    {
        return view('produk/form');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'price' => 'required',
            'desc' => 'required|max:250'
        ]);

        $status = \App\Models\produk::create($validated);

        if($status) return redirect('/')->with('succes', 'Data berhasil ditambahkan');
        else return redirect('/')->with('error', 'Data gagal ditambahkan');
    }
}