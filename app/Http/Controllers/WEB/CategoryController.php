<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::latest()->get();

        return view('pages.admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //fungi yang digunakan untuk menambahkan data

        //requesh validate
        $this->validate($request, [
            'name' => 'required|string|max:225',
        ]);

        //insert data ke database
        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name,'-')
        ]);

        if ($category) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.category.index')->with(['success' => 'Data berhasil disimpan']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.category.index')->with(['Error' => 'Data gaga; disimpan']);
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
        //cari data bu id
        $category = Category::findOrFail($id);
        return view('pages.admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //fungsi yang digunakan untuk meng-update data

        //request validate
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:categories,name,'. $id,

        ]);

        //cari data by id
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name,'-')
        ]);

        //redirect dengan pesan
        if ($category) {
            //redirect dengan pesan sukses
            return redirect()->route('dashboard.category.index')->with(['success' => 'Data berhasil diubah']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('dashboard.category.index')->with(['Error' => 'Data gaga; diubah']);
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
        $category = Category::findOrFail($id);
        $category->delete();

        if($category) {
            //redirect dengan pesan success
            return redirect()->route('dashboard.category.index')->with([
                'success' => 'Data berhasil dihapus'
            ]);
        } else {
            return redirect()->route('dashboard.category.index')->with([
                'error' => 'Data gagal dihapus'
            ]);
        }
    }
}
