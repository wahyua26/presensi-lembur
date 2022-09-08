<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        return new User([
            'npp'      => $row['npp'],
            'name'     => $row['nama'],
            'level'    => $row['level'],
            'jabatan'  => $row['jabatan'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password'])
        ]);
    }

    public function rules(): array
    {
        return [
            'npp' => ['required', 'unique:users,npp', 'numeric'],
            'nama' => ['required', 'string'],
            'level' => ['required', 'string'],
            'jabatan' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
        ];
    }
}
