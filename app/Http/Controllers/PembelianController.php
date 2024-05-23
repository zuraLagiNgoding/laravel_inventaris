<?php

namespace App\Http\Controllers;

use App\Exports\PembelianExport;
use App\Models\Barang;
use App\Models\Category;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelian = Pembelian::latest('id');

        if (request()->has('search')) {
        $searchTerm = request()->get('search', '');
        $pembelian = $pembelian->whereHas('barang', function ($query) use ($searchTerm) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                   ->orWhere('merk', 'LIKE', '%' . $searchTerm . '%')
                   ->orWhereHas('category', function ($query) use ($searchTerm) {
                       $query->where('name', 'LIKE', '%' . $searchTerm . '%');
                   });
          });
        }

        return view('pembelian.index', [
            'pembelians' => $pembelian->paginate(10)
        ]);
    }

    public function export()
    {
        return Excel::download(new PembelianExport, "daftar_riwayat_pembelian.xlsx");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::pluck('name', 'id')->toArray();
        return view('pembelian.save', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $barang = Barang::findOrFail($request->barang_id);

        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'amount' => 'required|integer|min:1',
        ]);

        Pembelian::create([
            'barang_id' => $request->barang_id,
            'amount' => $request->amount,
        ]);

        return redirect('pembelian')->with('status', "Pembelian barang $barang->name berhasil.");
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
    public function edit(string $id)
    {
        $pembelian = Pembelian::with('barang')->findOrFail($id);
        $barangs = Barang::pluck('name', 'id')->toArray();

        return view('pembelian.edit', compact('pembelian', 'barangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'amount' => 'required|integer|min:1',
        ]);

        Pembelian::findOrFail($id)->update([
            'barang_id' => $request->barang_id,
            'amount' => $request->amount,
        ]);

        return redirect('pembelian')->with('status','Berhasil update data pembelian.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembelian = Pembelian::with('barang')->findOrFail($id);

        $pembelian->delete();

        return redirect('pembelian')->with('status',"Data pembelian telah dihapus.");
    }
}
