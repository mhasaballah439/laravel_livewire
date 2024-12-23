<?php

namespace App\Exports;

use App\Models\UserSpecial;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserSpecialsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserSpecial::get();
    }

    public function headings(): array
    {
        return [
            'name',
            'active',
        ];
    }

    public function map($item): array
    {

        return [
            $item->name,
            $item->active == 1 ? 'true' : 'false',
        ];
    }
}
