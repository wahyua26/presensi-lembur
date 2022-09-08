<?php

namespace App\Exports;

use App\Models\Presensi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PresensiKaryawanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public $tglAwal;
    public $tglAkhir;
    public $npp;

    function __construct($tglAwal, $tglAkhir, $npp) {
            $this->tglAwal = $tglAwal;
            $this->tglAkhir = $tglAkhir;
            $this->npp = $npp;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')
        ->join('presensi', 'users.npp', '=', 'presensi.user_npp')
        ->where('users.npp', $this->npp)
        ->select(
        'users.name', 
        'users.npp',
        'presensi.tugas',
        'presensi.tgl',
        'presensi.jamMasuk',
        'presensi.latMasuk',
        'presensi.longMasuk',
        'presensi.jamKeluar',
        'presensi.latKeluar',
        'presensi.longKeluar',
        'presensi.lamaLembur')
        ->whereBetween('tgl',[$this->tglAwal, $this->tglAkhir])
        ->orderBy('tgl', 'asc')
        ->get();
    }
    
    public function headings():array{
        return[
            'nama pegawai',
            'user_npp',
            'tugas',
            'tgl',
            'jamMasuk',
            'latMasuk',
            'longMasuk',
            'jamKeluar',
            'latKeluar',
            'longKeluar',
            'lamaLembur'
        ];
    }
}
