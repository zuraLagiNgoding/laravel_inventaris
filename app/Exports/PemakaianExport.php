<?php

namespace App\Exports;

use App\Models\Pemakaian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PemakaianExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pemakaian::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Barang',
            'Merk/Type',
            'Category',
            'Tanggal Pakai',
            'Jumlah',
            'Ruang',
            'Keterangan',
        ];
    }

    /**
     * @param mixed $category
     * @return array
     */
    public function map($pemakaian): array
    {
        return [
            $pemakaian->id,
            $pemakaian->barang->name,
            $pemakaian->barang->merk,
            $pemakaian->barang->category->name,
            $pemakaian->updated_at,
            $pemakaian->amount,
            $pemakaian->ruang->name,
            $pemakaian->keterangan,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => '4F81BD',
                    ],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }
}
