<?php

namespace App\Http\Controllers\CRUD2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // JOIN TABLE untuk mengambil nama kategori
        $barangs = DB::table('barangs')
            ->join('categories', 'barangs.category_id', '=', 'categories.id')
            ->select('barangs.*', 'categories.name as category_name')
            ->orderBy('barangs.id', 'desc')
            ->get();

        return view('barangs.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data kategori untuk dropdown
        $categories = DB::table('categories')->get();
        return view('barangs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Insert data manual
        DB::table('barangs')->insert([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $barang = DB::table('barangs')->where('id', $id)->first();
        $categories = DB::table('categories')->get();

        return view('barangs.edit', compact('barang', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::table('barangs')->where('id', $id)->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('barangs')->where('id', $id)->delete();
        return redirect()->route('barangs.index')->with('success', 'Barang dihapus');
    }
}
