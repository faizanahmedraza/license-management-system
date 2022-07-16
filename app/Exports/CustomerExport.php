<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CustomerExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function headings(): array
    {
        return [
            ['#ID', 'First Name',"Last Name","Status","Created At"],
        ];
    }

    public function map($customer): array
    {
        return [
            $customer->id,
            ucwords($customer->first_name),
            ucwords($customer->last_name),
            array_flip(User::STATUS)[$customer->status],
            Date::dateTimeToExcel($customer->created_at),
        ];
    }

    public function query()
    {
        return User::query()->whereBetween('created_at', [$this->from,$this->to]);
    }
}
