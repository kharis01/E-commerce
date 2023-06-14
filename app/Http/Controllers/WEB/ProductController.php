<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::latest()->get();
        $category = Category::all();

        return view('pages.admin.product.index', compact('product', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();

        return view('pages.admin.product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Fungsi yang digunakan untuk insert data
        $this->validate($request, [
            'name' => 'required|string|max:225',
            'category_id' => 'required',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        //insert data ke database
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        if ($product) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.product.index')->with([
                'success' => 'Data berhasil ditambahkan'
            ]);
        } else {
            // reidrect dengan pesan error
            return redirect()->route('dashboard.product.index')->with([
                'error' => 'Data gagal ditambahkan'
            ]);
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Fungsi show yang digunakan untuk menampilkan data
        $product = Product::findOrFail($id);

        return view('pages.admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //untuk pergi ke halaman edit data

        $product = Product::findOrFail($id);
        // orderBy ASC digunakan untuk mengurutkan data berdasarkan A-Z
        $category = Category::orderBy('name', 'ASC')->get();

        return view('pages.admin.product.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        // Fungsi update yang digunakan untuk update data
        $this->validate($request, [
            'name' => 'required|string|max:225',
            'category_id' => 'required',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        //get data by id
        $product = Product::findOrfail($id);
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'slug' => Str::slug($request->name, '-'),
            'description' => $request->description,
        ]);

        if ($product) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.product.index')->with([
                'success' => 'Data berhasil diupdate'
            ]);
        } else {
            // reidrect dengan pesan error
            return redirect()->route('dashboard.product.index')->with([
                'error' => 'Data gagal diupdate'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        if($product) {
            //redirect dengan pesan success
            return redirect()->route('dashboard.product.index')->with([
                'success' => 'Data berhasil dihapus'
            ]);
        } else {
            return redirect()->route('dashboard.product.index')->with([
                'error' => 'Data gagal dihapus'
            ]);
        }
    }
}
