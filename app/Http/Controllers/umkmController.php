<?php

namespace App\Http\Controllers;

use App\Models\umkm;
use Illuminate\Http\Request;

class umkmController extends Controller
{
    public function index()
    {
        $data = umkm::get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'umkm_name' => 'required|max:100',
            'owner_name' => 'required|max:100',
            'umkm_desc' => 'required|max:255',
            'phone' => 'required|numeric',
            'email' => 'required|email|max:50|unique:umkm, email',
            'images' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename); // simpan di public/uploads
            $validated['images'] = 'uploads/' . $filename;  // simpan path relatif
        }

        $data = umkm::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil Ditambahkan',
            'data' => $data
        ]);
    }

    public function show(string $id)
    {
        $data = umkm::find($id);
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'umkm tidak ditemukan',
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
    
    public function update(Request $request, string $id)
    {
        $data = umkm::findOrFail($id);

        $validated = $request->validate([
            'umkm_name' => 'required|max:100',
            'owner_name' => 'required|max:100',
            'umkm_desc' => 'required|max:255',
            'phone' => 'required|digits_between:10,15',
            'email' => 'required|email|max:50|unique:umkm, email' . $id,
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
        $data = umkm::find($id);
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'umkm tidak ditemukan',
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
