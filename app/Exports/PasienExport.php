<?php

namespace App\Exports;

use App\Models\Pasien;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PasienExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection(): Collection
    {
        // sesuaikan kolom dengan tabel pasien kamu
        return Pasien::select(
            'no_rm',
            'nik',
            'nama_pasien',
            'jenis_kelamin',
            'tanggal_lahir',
            'alamat',
            'no_hp'
        )->orderBy('id_pasien', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No RM',
            'NIK',
            'Nama Pasien',
            'JK',
            'Tanggal Lahir',
            'Alamat',
            'No HP',
        ];
    }

    public function map($p): array
    {
        return [
            $p->no_rm,
            $p->nik,
            $p->nama_pasien,
            $p->jenis_kelamin,
            optional($p->tanggal_lahir)->format('Y-m-d') ?? '',
            $p->alamat,
            $p->no_hp,
        ];
    }
}
