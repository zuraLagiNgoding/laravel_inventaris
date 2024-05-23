<?php

namespace App\Http\Controllers;

use App\Exports\CategoryExport;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::latest('id');

        if (request()->has('search')) {
            $category = $category->where('name', 'LIKE', '%' . request()->get('search', '') . '%');
        }

        return view('category.index', [
            'categories' => $category->paginate(10)
        ]);
    }

    public function export()
    {
        return Excel::download(new CategoryExport, "laporan_category.xlsx");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.save');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string|unique:categories,name'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect('category')->with('status','Berhasil membuat category barang baru.');
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
    public function edit(int $id)
    {
        $category = Category::findOrFail($id);

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $categories = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|string|unique:categories,name,'. $categories->id
        ]);

        Category::findOrFail($id)->update([
            'name' => $request->name
        ]);

        return redirect('category')->with('status','Berhasil update category barang baru.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect('category')->with('status',"Category barang $category->name telah dihapus.");
    }
}
