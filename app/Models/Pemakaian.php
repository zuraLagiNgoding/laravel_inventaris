<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    protected $table = 'pemakaian';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pemakaian) {
            $barang = Barang::find($pemakaian->barang_id);
            if ($barang) {
                $barang->qty -= $pemakaian->amount;
                $barang->save();
            }
        });

        static::updating(function ($pemakaian) {
            $oldPembelian = Pembelian::find($pemakaian->id);
            $barang = Barang::find($pemakaian->barang_id);
            if ($barang) {
                $barang->qty += $oldPembelian->amount;
                $barang->qty -= $pemakaian->amount;
                $barang->save();
            }
        });

        static::deleting(function ($pemakaian) {
            $oldPembelian = Pembelian::find($pemakaian->id);
            $barang = Barang::find($pemakaian->barang_id);
            if ($barang) {
                $barang->qty += $oldPembelian->amount;
                $barang->save();
            }
        });
    }
    
    protected $fillable = ['barang_id', 'ruang_id', 'amount', 'keterangan'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);        
    }
    public function ruang()
    {
        return $this->belongsTo(Ruangan::class);        
    }
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
