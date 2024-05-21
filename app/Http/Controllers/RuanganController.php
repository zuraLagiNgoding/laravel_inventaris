<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangan = Ruangan::latest('id');

        if (request()->has('search')) {
            $ruangan = $ruangan->where('name', 'LIKE', '%' . request()->get('search', '') . '%');
        }

        return view('ruangan.index', [
            'ruangans' => $ruangan->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ruangan.save');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string|unique:ruangan,name',
            'deskripsi' => 'max:255'
        ]);

        Ruangan::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect('ruangan')->with('status','Berhasil membuat ruangan barang baru.');
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
        $ruangan = Ruangan::findOrFail($id);

        return view('ruangan.edit', compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ruangans = Ruangan::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|string|unique:ruangan,name'. $ruangans->id,
            'deskripsi' => 'max:255'
        ]);

        Ruangan::findOrFail($id)->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect('ruangan')->with('status','Berhasil update ruangan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $ruangan->delete();

        return redirect('ruangan')->with('status',"$ruangan->name telah dihapus.");
    }
}
