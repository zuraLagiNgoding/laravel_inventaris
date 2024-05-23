<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Barang;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::with('category')->latest('id');

        if (request()->has('search')) {
            $barang = $barang->where('name', 'LIKE', '%' . request()->get('search', '') . '%');
        }

        return view('barang.index', [
            'barangs' => $barang->paginate(10)
        ]);
    }

    public function export()
    {
        return Excel::download(new BarangExport, "laporan_barang.xlsx");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();
        return view('barang.save', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string|unique:barang,name',
            'merk' => 'max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer|min:0'
        ]);

        // Create a new Barang record
        Barang::create([
            'name' => $request->name,
            'merk' => $request->merk,
            'category_id' => $request->category_id,
            'qty' => 0,
            'price' => $request->price
        ]);

        return redirect('barang')->with('status','Berhasil membuat barang baru.');
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
        $barang = Barang::with('category')->findOrFail($id);
        $categories = Category::pluck('name', 'id')->toArray();

        return view('barang.edit', compact('barang', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|string|unique:barang,name,'. $barang->id,
            'merk' => 'max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer|min:0'
        ]);

        $barang->update([
            'name' => $request->name,
            'merk' => $request->merk,
            'category_id' => $request->category_id,
            'qty' => 0,
            'price' => $request->price
        ]);

        return redirect('barang')->with('status','Berhasil update category barang baru.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $barang = Barang::findOrFail($id);

        $barang->delete();

        return redirect('barang')->with('status',"Barang barang $barang->name telah dihapus.");
    }
}
