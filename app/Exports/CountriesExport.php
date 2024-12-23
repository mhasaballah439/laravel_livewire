<?php

namespace App\Exports;

use App\Models\Country;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CountriesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Country::get();
    }

    public function headings(): array
    {
        return [
            'name',
            'code',
            'active',
        ];
    }

    public function map($item): array
    {

        return [
            $item->name,
            $item->code,
            $item->active == 1 ? 'true' : 'false',
        ];
    }
}
