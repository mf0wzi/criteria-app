<?php


namespace App\Http\Override;
use Maatwebsite\Excel\HeadingRowImport;


class HeadingRowImportNew extends HeadingRowImport
{

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        return HeadingRowFormatterNew::format($row);
    }

}
