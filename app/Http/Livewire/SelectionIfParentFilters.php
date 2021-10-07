<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\SelectionIfFilter;

class SelectionIfParentFilters extends Component
{
    public $params;
    public $selectedFields = [];
    public $allFields = [];
    public $rowId, $rowTableName, $viewType, $rowHeaderData;

    protected $listeners = [
        'submit',
        'refreshData',
        'refreshComponent' => '$refresh',
        'resetAll'
    ];

    public function mount()
    {
        $selectedFieldsValues = SelectionIfFilter::where('parent_id','=',$this->params[0])
            ->orderBy('id', 'asc')->get();
        $selectedFieldsValues = sizeof($selectedFieldsValues) > 0 ? $selectedFieldsValues : [[
            "id" => null,
            "parent_id" => $this->params[0],
            "parent_uuid" => $this->params[1],
            "parent_table_name" => $this->params[2],
            "if_type" => "qualification",
            "if_uuid" => "",
            "if_level" => "0",
            "if_name" => "",
            "if_auto_name" => "",
            "if_field" => "",
            "if_condition" => "and",
            "if_operator" => "!=",
            "if_value" => "",
        ]];
        $this->selectedFields = $selectedFieldsValues;
    }

    public function refreshData()
    {
        $selectedFieldsValues = SelectionIfFilter::where('parent_id','=',$this->params[0])->orderBy('id', 'asc')->get();
        $selectedFieldsValues = sizeof($selectedFieldsValues) > 0 ? $selectedFieldsValues : [[
            "id" => null,
            "parent_id" => $this->params[0],
            "parent_uuid" => $this->params[1],
            "parent_table_name" => $this->params[2],
            "if_type" => "qualification",
            "if_uuid" => "",
            "if_level" => "0",
            "if_name" => "",
            "if_auto_name" => "",
            "if_field" => "",
            "if_condition" => "and",
            "if_operator" => "!=",
            "if_value" => "",
        ]];
        $this->selectedFields = $selectedFieldsValues;
    }

    function is_collection($param): bool
    {
        return (bool) (($param instanceof \Illuminate\Support\Collection) || ($param instanceof \Illuminate\Database\Eloquent\Collection));
    }

    public function deletedField($keys,$id)
    {
        unset($this->selectedFields[$keys]);
        $this->selectedFields = array_values($this->selectedFields->toArray());
        if($id != null)
        {
            $model = SelectionIfFilter::find( $id );
            $model->delete();
        }

    }

    public function resetAll()
    {
        $this->refreshData();
    }

    public function render()
    {
        return view('livewire.selection-if-parent-filters');
    }
}
