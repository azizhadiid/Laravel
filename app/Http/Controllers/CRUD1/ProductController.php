<?php

namespace App\Http\Controllers\CRUD1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        DB::table('products')->insert([
            'name' => $request->name,
            'price' => $request->price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/products');
    }

    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        DB::table('products')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'price' => $request->price,
                'updated_at' => now(),
            ]);

        return redirect('/products');
    }

    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect('/products');
    }
}
