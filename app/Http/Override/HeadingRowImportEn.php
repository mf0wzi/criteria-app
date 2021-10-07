<?php


namespace App\Http\Override;
use Maatwebsite\Excel\HeadingRowImport;


class HeadingRowImportEn extends HeadingRowImport
{

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        return HeadingRowFormatterEn::format($row);
    }

}
