<?php

namespace App\Http\Livewire;

use App\Models\GetExcelUpload;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class ViewUploadExcel extends LivewireDatatable
{
    public $params = array();
    public $header;
    public $hideable = 'select';
    public $exportable = true;

    public function builder()
    {
        return (new GetExcelUpload())->setTable($this->params[2])->newQuery()->where('id', '<>', 1);
    }

    public function columns()
    {
        $columns = [
            NumberColumn::name('id')
                ->defaultSort('asc')
                ->label('ID')
                ->hide(),
        ];
//        dd($this->params);
        foreach ($this->params[3][0][0] as $keys => &$value) {

            array_push($columns,
                Column::name($keys)
                    ->label($value)
                    ->searchable()
                    ->truncate(100)
                    ->filterable()
                    ->alignCenter()
            );

        }
        return $columns;
    }
}
