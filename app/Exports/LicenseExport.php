<?php

namespace App\Exports;

use App\Models\License;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LicenseExport implements FromQuery, WithHeadings, WithMapping
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
            ['#ID', 'Product Name', "Customer Name", "License Code", "License Type", "Status", "Created At", "Expiry Date"],
        ];
    }

    public function map($license): array
    {
        return [
            $license->id,
            ucwords($license->product->name),
            ucwords($license->user->full_name),
            $license->license_code,
            ucwords($license->license_type),
            array_flip(License::STATUS)[$license->status],
            Date::dateTimeToExcel($license->created_at),
            $license->expiry,
        ];
    }

    public function query()
    {
        return License::query()->with(['user', 'product'])->whereBetween('created_at', [$this->from, $this->to]);
    }
}
