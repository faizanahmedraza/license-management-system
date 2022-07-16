<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProductExport implements FromQuery, WithHeadings, WithMapping
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
            ['#ID', 'Product Name',"Short Code","Version Number","Description","Created At"],
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            ucwords($product->name),
            $product->short_code,
            $product->version_number,
            $product->description,
            Date::dateTimeToExcel($product->created_at),
        ];
    }

    public function query()
    {
        return Product::query()->whereBetween('created_at', [$this->from,$this->to]);
    }
}
