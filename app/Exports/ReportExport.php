<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection
{
    // public $report;

    // public function __construct($report)
    // {
    //     $this->report = $report;
    // }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Report::all();
    }

    // public function headings(): array
    // {
    //     return [
    //         'Mahsulot nomi',
    //         'Sotilgan mahsulot soni',
    //         'Mahsulot asl narxi',
    //         'Mahsulot sotilgan narxi',
    //         'Sof foyda',
    //         'Mahsulot sotilgan kuni',
    //     ];
    // }
}
