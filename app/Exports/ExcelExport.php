<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;

class ExcelExport implements WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function registerEvents(): array
    {
    }
}
