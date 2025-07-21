<?php
namespace App\Exports;

use App\Models\Repot;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportExcel implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Repot::with('user')->orderBy('created_at', 'ASC')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Email Pelapor',
            'Dilaporkan Tanggal',
            'Deskripsi Keluhan',
            'Lokasi',
            'Jumlah Voting',
            'Status Pengaduan'
        ];
    }

    /**
     * @param mixed $repot
     * @return array
     */
    public function map($repot): array
    {
        return [
            $repot->user->email,
            $repot->created_at->format('Y-m-d'),
            $repot->keluhan,
            $repot->desa . ', ' . $repot->kecamatan . ', ' . $repot->provinsi,
            $repot->voting,
            $repot->respon_status,
        ];
    }
}