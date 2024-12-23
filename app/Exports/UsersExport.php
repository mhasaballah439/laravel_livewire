<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection , WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::get();
    }

    public function headings(): array
    {
        return [
            'username',
            'name',
            'email',
            'phone',
            'store name',
            'language',
            'currency',
            'special',
            'active',
        ];
    }

    public function map($item): array
    {

        return [
            $item->username,
            $item->name,
            $item->email,
            $item->phone,
            $item->store_name,
            $item->language->name ?? '-',
            $item->currency->name ?? '-',
            $item->special->name ?? '-',
            $item->active == 1 ? 'true' : 'false',
        ];
    }
}
