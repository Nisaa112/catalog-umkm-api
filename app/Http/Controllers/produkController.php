<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    public function index()
    {
        $data = produk::with('kategori')->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'id_kategori' => 'required|exists:kategori,id',
            'rating' => 'required|numeric|between:0,5',
            'price' => 'required|numeric',
            'description' => 'required|max:255',
            'images' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename); // simpan di public/uploads
            $validated['images'] = 'uploads/' . $filename;  // simpan path relatif
        }

        $data = produk::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil Ditambahkan',
            'data' => $data
        ]);
    }

    public function show(string $id)
    {
        $data = produk::with('kategori')->find($id);
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Produk tidak ditemukan',
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
    
    public function update(Request $request, string $id)
    {
        $data = produk::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|max:100',
            'id_kategori' => 'required|exists:kategori,id',
            'rating' => 'required|numeric|between:0,5',
            'price' => 'required|numeric',
            'description' => 'required|max:255',
            'images' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('images')) {
            // Hapus images lama jika ada
            if ($data->images && file_exists(public_path($data->images))) {
                unlink(public_path($data->images));
            }

            $file = $request->file('images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['images'] = 'uploads/' . $filename;
        }

        $data->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Update berhasil',
            'data' => $data
        ], 200);
    }

    public function destroy(string $id)
    {
        $data = produk::find($id);
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Produk tidak ditemukan',
            ], 404);
        }

        // Hapus file gambar
        if ($data->images && file_exists(public_path($data->images))) {
            unlink(public_path($data->images));
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Update berhasil',
        ], 200);
    }
}