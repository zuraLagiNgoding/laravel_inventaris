<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use App\Models\Pemakaian;
use App\Models\Pembelian;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategory = Category::count();
        $totalBarang = Barang::count();
        $totalRuangan = Ruangan::count();
        
        $totalPembelian = Pembelian::count();
        $totalPemakaian = Pemakaian::count();

        return view('dashboard', compact('totalCategory', 'totalBarang', 'totalRuangan', 'totalPembelian', 'totalPemakaian'));
    }
}
