<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('npp', 'name', 'level', 'jabatan', 'email')->get();
    }

    public function headings():array{
        return[
            'npp', 'nama karyawan', 'level', 'jabatan', 'email'
        ];
    }
}
