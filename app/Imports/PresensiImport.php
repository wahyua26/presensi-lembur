<?php

namespace App\Imports;

use App\Models\Presensi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithValidation;

class PresensiImport implements ToModel, WithHeadingRow, WithCalculatedFormulas, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function model(array $row)
    {
        //dd($this->transformDate($row['tanggal']));
        return new Presensi([
            'user_npp' => $row['npp'],
            'tugas' => $row['tugas'],
            'tgl' => $this->transformDate($row['tanggal']),
            'jamMasuk' => $this->transformDate($row['jam_masuk']),
            'fotoMasuk' => $row['foto_masuk'],
            'latMasuk' => $row['lat_masuk'],
            'longMasuk' => $row['long_masuk'],
            'jamKeluar' => $this->transformDate($row['jam_keluar']),
            'fotoKeluar' => $row['foto_keluar'],
            'latKeluar' => $row['lat_keluar'],
            'longKeluar' => $row['long_keluar'],
            'lamaLembur' => $this->transformDate($row['lama_lembur'])
        ]);
    }

    public function rules(): array
    {
        return [
            'npp' => ['required', 'numeric'],
            'tugas' => ['required', 'string'],
            'tanggal' => ['required'],
            'jam_masuk' => ['required'],
            'foto_masuk' => ['required'],
            'lat_masuk' => ['required'],
            'long_masuk' => ['required'],
            'jam_keluar' => ['required'],
            'foto_keluar' => ['required'],
            'lat_keluar' => ['required'],
            'long_keluar' => ['required'],
            'lama_lembur' => ['required'],
        ];
    }
}
