<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection
{
    protected $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }
    public function collection()
    {
        return $this->convertToCollection($this->data);
    }

    public function convertToCollection(array $array)
    {
        $collection = new Collection();
        foreach ($array as $item) {
            $collection->push((object) $item);
        }
        return $collection;
    }

}
