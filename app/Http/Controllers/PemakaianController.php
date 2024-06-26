<?php

namespace App\Http\Controllers;

use App\Exports\PemakaianExport;
use App\Models\Barang;
use App\Models\Pemakaian;
use App\Models\Ruangan;
use App\Rules\MaxAmount;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemakaian = Pemakaian::with('barang')->with('category')->latest('id');

        if (request()->has('search')) {
        $searchTerm = request()->get('search', '');
        $pemakaian = $pemakaian->whereHas('barang', function ($query) use ($searchTerm) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                   ->orWhere('merk', 'LIKE', '%' . $searchTerm . '%')
                   ->orWhereHas('category', function ($query) use ($searchTerm) {
                       $query->where('name', 'LIKE', '%' . $searchTerm . '%');
                   });
          });
        }

        return view('pemakaian.index', [
            'pemakaians' => $pemakaian->paginate(10)
        ]);
    }

    public function export()
    {
        return Excel::download(new PemakaianExport, "daftar_riwayat_pemakaian.xlsx");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::pluck('name', 'id')->toArray();
        $ruangans = Ruangan::pluck('name', 'id')->toArray();
        return view('pemakaian.save', compact('barangs', 'ruangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $barang = Barang::findOrFail($request->barang_id);
        $qty = $barang->qty;

        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'amount' => ['required', 'integer', 'min:1', new MaxAmount($qty)],
            'keterangan' => 'max:255',
        ]);

        Pemakaian::create([
            'barang_id' => $request->barang_id,
            'ruang_id' => $request->ruang_id,
            'amount' => $request->amount,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('pemakaian')->with('status', "Pemakaian barang $barang->name berhasil.");
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
