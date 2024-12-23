<?php

namespace App\Imports;

use App\Models\Country;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CountriesImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $country = Country::where('name',$row['name'])->first();
        if (!$country) {
            return new Country([
                'name' => $row['name'],
                'code' => $row['code'],
                'active' => 1,
            ]);
        }
    }
}
