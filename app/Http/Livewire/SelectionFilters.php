<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\SelectionFilter;
use App\Models\ExcelStore;

class SelectionFilters extends Component
{
    public $params;
    public $selectedFields = [];
    public $selectedGroupFields = [];
    public $allFields = [];
    public $rowId, $rowTableName, $viewType, $rowHeaderData;
    public $deleteKeys, $deleteId;

    protected $listeners = [
        'submit',
        'refreshData',
        'refreshComponent' => '$refresh',
        'resetAll',
        'confirmedDelete',
        'cancelled'
    ];

    protected $rules = [
        'selectedFields.*.id' => 'integer',
        'selectedFields.*.parent_id' => 'required|integer',
        'selectedFields.*.parent_uuid' => 'required|string',
        'selectedFields.*.parent_table_name' => 'required|string',
        'selectedFields.*.criteria_type' => 'required|string',
        'selectedFields.*.criteria_group_uuid' => 'nullable|string',
        'selectedFields.*.criteria_group_level' => 'nullable|integer',
        'selectedFields.*.criteria_group_type' => 'nullable|string',
        'selectedFields.*.criteria_group_name' => 'nullable|string',
        'selectedFields.*.criteria_group_auto_name' => 'nullable|string',
        'selectedFields.*.criteria_field' => 'nullable|required|string',
        'selectedFields.*.criteria_condition' => 'nullable|required|string',
        'selectedFields.*.criteria_operator' => 'nullable|required|string',
        'selectedFields.*.criteria_value' => 'required|string',
    ];

    public function mount()
    {
//        var_dump(Str::orderedUuid()->toString());
        $this->reset(['allFields','selectedFields']);
        $field = json_decode(ExcelStore::find($this->params[0])->value('excel_file_header'), true);
        $selectedFieldsValues = SelectionFilter::where('parent_id','=',$this->params[0])->orderBy('id', 'asc')->get();
        $selectedFieldsValues = sizeof($selectedFieldsValues) > 0 ? $selectedFieldsValues : [[
            "id" => "",
            "parent_id" => $this->params[0],
            "parent_uuid" => $this->params[1],
            "parent_table_name" => $this->params[2],
            "criteria_type" => "qualification",
            "criteria_group_uuid" => "",
            "criteria_group_level" => "0",
            "criteria_group_type" => "",
            "criteria_group_name" => "",
            "criteria_group_auto_name" => "",
            "criteria_field" => "",
            "criteria_condition" => "and",
            "criteria_operator" => "!=",
            "criteria_value" => "",
        ]];


        $this->allFields = $field[0][0];
        $this->selectedFields = $selectedFieldsValues;
    }

    public function submit()
    {

        $this->validate();
        $message = "None";
        $type = 'info';
        try {
            foreach($this->selectedFields as $key => $selectedField)
            {
                if($selectedField['id'] == "") {
                    SelectionFilter::create([
                        "parent_id" => $selectedField['parent_id'],
                        "parent_uuid" => $selectedField['parent_uuid'],
                        "parent_table_name" => $selectedField['parent_table_name'],
                        "criteria_type" => $selectedField['criteria_type'],
                        "criteria_group_uuid" => $selectedField['criteria_group_uuid'],
                        "criteria_group_level" => 0,
                        "criteria_group_type" => $selectedField['criteria_group_type'],
                        "criteria_group_name" => $selectedField['criteria_group_name'],
                        "criteria_group_auto_name" => $selectedField['criteria_group_auto_name'],
                        "criteria_field" => $selectedField['criteria_field'],
                        "criteria_condition" => $selectedField['criteria_condition'],
                        "criteria_operator" => $selectedField['criteria_operator'],
                        "criteria_value" => $selectedField['criteria_value'],
                    ]);
                    $message = "Qualification Created Successfully!!";
                    $type = "success";
                } else {
                    SelectionFilter::find($selectedField['id'])->update([
                        "criteria_group_uuid" => $selectedField['criteria_group_uuid'],
                        "criteria_group_level" => $selectedField['criteria_group_level'],
                        "criteria_group_type" => $selectedField['criteria_group_type'],
                        "criteria_group_name" => $selectedField['criteria_group_name'],
                        "criteria_group_auto_name" => $selectedField['criteria_group_auto_name'],
                        "criteria_field" => $selectedField['criteria_field'],
                        "criteria_condition" => $selectedField['criteria_condition'],
                        "criteria_operator" => $selectedField['criteria_operator'],
                        "criteria_value" => $selectedField['criteria_value'],
                    ]);
                    $message = "Qualification Updated Successfully!!";
                    $type = "info";
                }
                $this->emitSelf('refreshComponent');
                $this->emitSelf('refreshData');
                $this->emit('saved');
                $this->alert($type, $message, [
                    'timer' => 5000,
                    'timerProgressBar' => true,
                ]);

//                $this->dispatchBrowserEvent('alert',[
//                    'type'=> $type,
//                    'message'=> $message
//                ]);
            }

        } catch (Exception $e) {
            $this->alert('error', "Please try again later.");
        }
    }

    public function refreshData()
    {
//        dd('here');
        $field = json_decode(ExcelStore::find($this->params[0])->value('excel_file_header'), true);
        $selectedFieldsValues = SelectionFilter::where('parent_id','=',$this->params[0])->orderBy('id', 'asc')->get();
        $selectedFieldsValues = sizeof($selectedFieldsValues) > 0 ? $selectedFieldsValues : [[
            "id" => "",
            "parent_id" => $this->params[0],
            "parent_uuid" => $this->params[1],
            "parent_table_name" => $this->params[2],
            "criteria_type" => "qualification",
            "criteria_group_uuid" => "",
            "criteria_group_level" => "0",
            "criteria_group_type" => "",
            "criteria_group_name" => "",
            "criteria_group_auto_name" => "",
            "criteria_field" => "",
            "criteria_condition" => "and",
            "criteria_operator" => "!=",
            "criteria_value" => "",
        ]];

        $this->allFields = $field[0][0];
        $this->selectedFields = $selectedFieldsValues;
    }

    function is_collection($param): bool
    {
        return (bool) (($param instanceof \Illuminate\Support\Collection) || ($param instanceof \Illuminate\Database\Eloquent\Collection));
    }

    public function addField()
    {
        $type = $this->is_collection($this->selectedFields);
        $collection = null;
        if($type){
            $collection = collect([
                "id" => "",
                "parent_id" => $this->params[0],
                "parent_uuid" => $this->params[1],
                "parent_table_name" => $this->params[2],
                "criteria_type" => "qualification",
                "criteria_group_uuid" => "",
                "criteria_group_level" => "0",
                "criteria_group_type" => "",
                "criteria_group_name" => "",
                "criteria_group_auto_name" => "",
                "criteria_field" => "",
                "criteria_condition" => "and",
                "criteria_operator" => "!=",
                "criteria_value" => "",
            ]);
            $this->selectedFields[] = $collection;
            $this->selectedFields = $this->selectedFields->toArray();
        } else {
            $collection = [
                "id" => "",
                "parent_id" => $this->params[0],
                "parent_uuid" => $this->params[1],
                "parent_table_name" => $this->params[2],
                "criteria_type" => "qualification",
                "criteria_group_uuid" => "",
                "criteria_group_level" => "0",
                "criteria_group_type" => "",
                "criteria_group_name" => "",
                "criteria_group_auto_name" => "",
                "criteria_field" => "",
                "criteria_condition" => "and",
                "criteria_operator" => "!=",
                "criteria_value" => "",
            ];
            $this->selectedFields[] = $collection;
        }
    }

    public function addGroup()
    {

    }

    public function deletedField($keys,$id)
    {
        $this->deleteKeys = $keys;
        $this->deleteId = $id;
        $this->confirm('Do you want to delete this row ?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Nope',
            'onConfirmed' => 'confirmedDelete',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmedDelete()
    {
        // Example code inside confirmed callback
//        dd('test'. $this->deleteId);
        unset($this->selectedFields[$this->deleteKeys]);
        $this->selectedFields = array_values($this->selectedFields->toArray());
        if($this->deleteId != null)
        {
            $model = SelectionFilter::find( $this->deleteId );
            $model->delete();
        }
        $this->alert(
            'error',
            'Qualification is deleted!!!'
        );
    }

    public function cancelled()
    {
        // Example code inside cancelled callback
        $this->reset('deleteKeys', 'deleteId');
        $this->alert('info', 'Nothing is deleted');
    }

    public function resetAll()
    {
        $this->refreshData();
    }

    public function render()
    {
//        info();
        return view('livewire.selection-filters');
    }
}
