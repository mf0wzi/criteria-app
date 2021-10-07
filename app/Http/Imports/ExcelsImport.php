<?php

namespace App\Http\Imports;

use App\Models\File;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelsImport implements ToModel
{
    public function __construct($texts, $table)
    {
        $this->texts = $texts;
        $this->table_name = $table;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $array = $this->texts;
        $final = [];
        foreach($array as $key => $column){
            $final[$column] = $row[$key];
        }
        $final['table_name'] = $this->table_name;
        return new File($final);
    }
}
