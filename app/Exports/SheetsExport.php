<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class SheetsExport implements FromCollection, WithHeadings
{
    use Exportable;
    protected $headers;
    protected $data;
    public function __construct(array $data, array $headers)
    {
        $this->data = $data;
        $this->headers = $headers;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->data);
    }

    /**
     * Add Sheet Headers 
     */
    public function headings(): array
    {
        return  [$this->headers];
    }
}
