<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pembelian) {
            $barang = Barang::find($pembelian->barang_id);
            if ($barang) {
                $barang->qty += $pembelian->amount;
                $barang->save();
            }
        });

        static::updating(function ($pembelian) {
            $oldPembelian = Pembelian::find($pembelian->id);
            $barang = Barang::find($pembelian->barang_id);
            if ($barang) {
                $barang->qty -= $oldPembelian->amount;
                $barang->qty += $pembelian->amount;
                $barang->save();
            }
        });

        static::deleting(function ($pembelian) {
            $oldPembelian = Pembelian::find($pembelian->id);
            $barang = Barang::find($pembelian->barang_id);
            if ($barang) {
                $barang->qty -= $oldPembelian->amount;
                $barang->save();
            }
        });
    }
    
    protected $fillable = ['barang_id', 'amount'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);        
    }
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
