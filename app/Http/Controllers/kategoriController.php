<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function index()
    {
        $data['result'] = \App\Models\kategori::all();
        return view('kategori/index')->with($data);
    }
}
