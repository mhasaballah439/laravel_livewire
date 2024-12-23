<?php

namespace App\Imports;

use App\Models\UserSpecial;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserSpecialsImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $lang = UserSpecial::where('name',$row['name'])->first();
        if (!$lang) {
            return new UserSpecial([
                'name' => $row['name'],
                'active' => 1,
            ]);
        }
    }
}
