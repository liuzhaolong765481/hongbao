<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class PaperExport implements FromCollection
{
    // 要导出的数据
    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return collect($this->data);
    }
}
