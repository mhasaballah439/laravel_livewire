<?php

namespace App\Imports;

use App\Models\Currency;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CurrenciesImport implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $item = Currency::where('name',$row['name'])->first();
        if (!$item) {
            return new Currency([
                'name' => $row['name'],
                'code' => $row['code'],
                'active' => 1,
            ]);
        }
    }
}
