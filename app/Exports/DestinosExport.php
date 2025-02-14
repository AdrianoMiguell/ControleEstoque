<?php

namespace App\Exports;

use App\Models\Destino;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DestinosExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $query;

    public function __construct($query = null)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        return ['ID', 'Nome', 'Tipo', 'Descrição'];
    }
}
