<?php

namespace App\Http\Livewire;

use App\Models\ExcelStore;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ExcelList extends LivewireDatatable
{
    public $actionActivation = false;

    public function builder()
    {
        return ExcelStore::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->defaultSort('desc')
                ->label('ID'),
            Column::name('uuid')
                ->label('UUID')
                ->hide(),
            Column::name('auto_generated_name')
                ->label('Auto Generated Name')
                ->linkTo('file')
                ->hide(),
            Column::name('name')
                ->searchable()
                ->filterable(),
            Column::name('description')
                ->searchable()
                ->filterable(),
            Column::name('excel_file_header')
                ->label('Excel File Header')
                ->hide(),
            DateColumn::name('created_at'),
            Column::callback(['id', 'uuid', 'name', 'auto_generated_name',  'excel_file_header'], function ($id, $uuid, $name, $rowTableName, $excel_file_header) {
                return view('livewire.table-actions',
                    [
                        'rowId' => $id,
                        'rowUUID' => $uuid,
                        'name' => $name,
                        'rowTableName' => $rowTableName,
                        'rowHeaderData' => $excel_file_header,
                        'rowCriteriaCount' => DB::table('selection_filters')->where('parent_id','=', $id)->where('deleted_at','=', null)->count()
                    ]);
//                return view('livewire.table-actions', ['id' => $id, 'name' => $name, 'excel_file_header' => $excel_file_header]);
            }),
        ];
    }



    public function view($id, $uuid, $rowTableName, $viewType, $data)
    {
        $this->emit('openmodal',$id, $uuid, $rowTableName, $viewType, $data);
    }

    public function edit($id)
    {
//        ExcelStore::find($id)->delete();
        $this->emit('refreshLivewireDatatable');
    }

    public function delete($id)
    {
        ExcelStore::find($id)->delete();
        $this->emit('refreshLivewireDatatable');
    }
}
