<?php

namespace App\Imports;

use App\Models\Language;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LanguagesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $lang = Language::where('name',$row['name'])->first();
        if (!$lang) {
            return new Language([
                'name' => $row['name'],
                'code' => $row['code'],
                'active' => 1,
            ]);
        }
    }
}
