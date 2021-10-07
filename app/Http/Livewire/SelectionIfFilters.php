<?php

namespace App\Http\Livewire;

use App\Models\ExcelStore;
use App\Models\SelectionIfFilter;
use Livewire\Component;
use Illuminate\Support\Str;

class SelectionIfFilters extends Component
{
    public $params;
    public $startMountValue = false;
    public $if_id,
        $if_condition,
        $if_operator,
        $if_uuid,
        $if_auto_name,
        $if_name,
        $if_level,
        $if_type,
        $if_value,
        $else_value;
    public $selectedIfFields = [];
    public $allIfFields = [];

    protected $listeners = [
        'submitData' => 'submit',
        'editData' => 'editIfField',
        'refreshData',
        'refreshComponent' => '$refresh',
    ];
    protected $rules = [
        'if_id' => 'nullable|integer',
        'if_condition' => 'required|string',
        'if_operator' => 'required|string',
        'if_uuid' => 'required|string',
        'if_level' => 'required|integer',
        'if_type' => 'required|string',
        'if_name' => 'required|string',
        'if_auto_name' => 'nullable|string',
        'selectedIfFields.*.id' => 'integer',
        'selectedIfFields.*.parent_id' => 'required|integer',
        'selectedIfFields.*.parent_uuid' => 'required|string',
        'selectedIfFields.*.parent_table_name' => 'required|string',
        'selectedIfFields.*.if_type' => 'required|string',
        'selectedIfFields.*.if_uuid' => 'nullable|string',
        'selectedIfFields.*.if_level' => 'nullable|integer',
        'selectedIfFields.*.if_name' => 'nullable|string',
        'selectedIfFields.*.if_auto_name' => 'nullable|string',
        'selectedIfFields.*.if_field' => 'nullable|required|string',
        'selectedIfFields.*.if_condition' => 'nullable|required|string',
        'selectedIfFields.*.if_operator' => 'nullable|required|string',
        'selectedIfFields.*.if_value' => 'required|string',
    ];

    public function mount()
    {
        $this->reset(['allIfFields', 'selectedIfFields']);
        $this->if_condition = is_null($this->if_condition) ? 'and' : $this->if_condition;
        $this->if_operator = is_null($this->if_operator) ? '!=' : $this->if_operator;
        $this->if_uuid = is_null($this->if_uuid) ? Str::orderedUuid()->toString() : $this->if_uuid;
        $this->if_auto_name = is_null($this->if_auto_name) ? 'If_'.Str::random(20) : $this->if_auto_name;
        $this->if_name = is_null($this->if_name) ? '' : $this->if_name;
        $this->if_level = is_null($this->if_level) ? 0 : $this->if_level;
        $this->if_type = is_null($this->if_type) ? 'parent' : $this->if_type;
        $this->if_id = is_null($this->if_id) ? null : $this->if_id;
        $this->if_value = is_null($this->if_value) ? null : $this->if_value;
        $this->else_value = is_null($this->else_value) ? null : $this->else_value;
        if(!is_null($this->params[0])) {
            $field = json_decode(ExcelStore::find($this->params[0])->value('excel_file_header'), true);
            $selectedFieldsValues = SelectionIfFilter::where('parent_id', '=', $this->params[0])
                ->where('if_uuid', '=', $this->if_uuid)
                ->orderBy('id', 'asc')->get();
            $selectedFieldsValues = sizeof($selectedFieldsValues) > 0 ? $selectedFieldsValues : [[
                "id" => "",
                "parent_id" => $this->params[0],
                "parent_uuid" => $this->params[1],
                "parent_table_name" => $this->params[2],
                "if_uuid" => $this->if_uuid,
                "if_level" => "1",
                "if_type" => "child",
                "if_name" => $this->if_name,
                "if_auto_name" => $this->if_auto_name,
                "if_field" => "",
                "if_condition" => "and",
                "if_operator" => "!=",
                "if_value" => "NONE",
                "else_value" => "NONE",
            ]];

            $this->allIfFields = $field[0][0];
            $this->selectedIfFields = $selectedFieldsValues;
        }
    }

    public function startMount(){
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->reset(['allIfFields', 'selectedIfFields']);
        $field = json_decode(ExcelStore::find($this->params[0])->value('excel_file_header'), true);
        $selectedFieldsValues = SelectionIfFilter::where('parent_id','=',$this->params[0])
            ->where('if_uuid','=',$this->if_uuid)
            ->where('if_level','=',1)
            ->orderBy('id', 'asc')->get();
        $selectedId = SelectionIfFilter::where('parent_id','=',$this->params[0])
            ->where('if_uuid','=',$this->if_uuid)
            ->where('if_level','=',0)
            ->value('id');

        $selectedFieldsValues = sizeof($selectedFieldsValues) > 0 ? $selectedFieldsValues : [[
            "id" => "",
            "parent_id" => $this->params[0],
            "parent_uuid" => $this->params[1],
            "parent_table_name" => $this->params[2],
            "if_uuid" => $this->if_uuid,
            "if_level" => "1",
            "if_type" => "child",
            "if_name" => $this->if_name,
            "if_auto_name" => $this->if_auto_name,
            "if_field" => "",
            "if_condition" => "and",
            "if_operator" => "!=",
            "if_value" => "NONE",
            "else_value" => "NONE",
        ]];

        $this->allIfFields = $field[0][0];
        $this->if_id = $selectedId;
        $this->selectedIfFields = $selectedFieldsValues;
        $this->emitTo('selection-filters', 'refreshData');
    }

    function is_collection($param): bool
    {
        return (bool) (($param instanceof \Illuminate\Support\Collection) || ($param instanceof \Illuminate\Database\Eloquent\Collection));
    }

    public function addIfField()
    {
//        dd('here');
        $type = $this->is_collection($this->selectedIfFields);
        $collection = null;
        if($type){
            $collection = collect([
                "id" => "",
                "parent_id" => $this->params[0],
                "parent_uuid" => $this->params[1],
                "parent_table_name" => $this->params[2],
                "if_uuid" => $this->if_uuid,
                "if_level" => "1",
                "if_type" => "child",
                "if_name" => $this->if_name,
                "if_auto_name" => $this->if_auto_name,
                "if_field" => "",
                "if_condition" => "and",
                "if_operator" => "!=",
                "if_value" => "NONE",
                "else_value" => "NONE",
            ]);
            $this->selectedIfFields[] = $collection;
            $this->selectedIfFields = $this->selectedIfFields->toArray();
        } else {
            $collection = [
                "id" => "",
                "parent_id" => $this->params[0],
                "parent_uuid" => $this->params[1],
                "parent_table_name" => $this->params[2],
                "if_uuid" => $this->if_uuid,
                "if_level" => "1",
                "if_type" => "child",
                "if_name" => $this->if_name,
                "if_auto_name" => $this->if_auto_name,
                "if_field" => "",
                "if_condition" => "and",
                "if_operator" => "!=",
                "if_value" => "NONE",
                "else_value" => "NONE",
            ];
            $this->selectedIfFields[] = $collection;
        }
    }

    public function editIfField($keys,$id, $IfUUID){
//        dd($this->params[0]);
        $field = json_decode(ExcelStore::find($this->params[0])->value('excel_file_header'), true);
        $selectedFieldsValues = SelectionIfFilter::where('parent_id','=',$this->params[0])
            ->where('if_uuid','=',$IfUUID)
            ->where('if_level','=',1)
            ->orderBy('id', 'asc')->get();
//        $selectedId = SelectionIfFilter::where('parent_id','=',$this->params[0])
//            ->where('if_uuid','=',$this->if_uuid)
//            ->where('if_level','=',0)
//            ->value('id');
//
        $selectedFieldsValues = sizeof($selectedFieldsValues) > 0 ? $selectedFieldsValues : [[
            "id" => "",
            "parent_id" => $this->params[0],
            "parent_uuid" => $this->params[1],
            "parent_table_name" => $this->params[2],
            "if_uuid" => $this->if_uuid,
            "if_level" => "1",
            "if_type" => "child",
            "if_name" => $this->if_name,
            "if_auto_name" => $this->if_auto_name,
            "if_field" => "",
            "if_condition" => "and",
            "if_operator" => "!=",
            "if_value" => "NONE",
            "else_value" => "NONE",
        ]];

        $this->allIfFields = $field[0][0];
        $this->if_id = $id;
        $this->selectedIfFields = $selectedFieldsValues;
        $this->emit('openIfModal');
    }

    public function deletedIfField($keys,$id)
    {
        unset($this->selectedIfFields[$keys]);
        $this->selectedIfFields = array_values($this->selectedIfFields->toArray());
        if($id != null)
        {
            $model = SelectionIfFilter::find( $id );
            $model->delete();
        }

    }

    public function submit()
    {

        $this->validate();

        try {

            if(is_null($this->if_id) || $this->if_id == ""){
                SelectionIfFilter::create([
                    "id" => "",
                    "parent_id" => $this->params[0],
                    "parent_uuid" => $this->params[1],
                    "parent_table_name" => $this->params[2],
                    "if_uuid" => $this->if_uuid,
                    "if_level" => "0",
                    "if_type" => "parent",
                    "if_name" => $this->if_name,
                    "if_auto_name" => $this->if_auto_name,
                    "if_field" => $this->if_name,
                    "if_condition" => $this->if_condition,
                    "if_operator" => "If",
                    "if_value" => $this->if_value,
                    "else_value" => $this->else_value,
                ]);
            } else {
                SelectionIfFilter::find($this->if_id)->update([
                    "if_name" => $this->if_name,
                    "if_condition" => $this->if_condition,
                    "if_field" => $this->if_name,
                    "if_operator" => "If",
                    "if_value" => $this->if_value,
                    "else_value" => $this->else_value,
                ]);
            }

            foreach($this->selectedIfFields as $key => $selectedField)
            {
                if($selectedField['id'] == "") {
                    SelectionIfFilter::create([
                        "parent_id" => $selectedField['parent_id'],
                        "parent_uuid" => $selectedField['parent_uuid'],
                        "parent_table_name" => $selectedField['parent_table_name'],
                        "if_uuid" => $selectedField['if_uuid'],
                        "if_level" => $selectedField['if_level'],
                        "if_type" => $selectedField['if_type'],
                        "if_name" => $selectedField['if_name'],
                        "if_auto_name" => $selectedField['if_auto_name'],
                        "if_field" => $selectedField['if_field'],
                        "if_condition" => $selectedField['if_condition'],
                        "if_operator" => $selectedField['if_operator'],
                        "if_value" => $selectedField['if_value'],
                        "else_value" => $selectedField['else_value'],
                    ]);
                } else {
                    SelectionIfFilter::find($selectedField['id'])->update([
                        "if_uuid" => $selectedField['if_uuid'],
                        "if_level" => $selectedField['if_level'],
                        "if_type" => $selectedField['if_type'],
                        "if_name" => $selectedField['if_name'],
                        "if_auto_name" => $selectedField['if_auto_name'],
                        "if_field" => $selectedField['if_field'],
                        "if_condition" => $selectedField['if_condition'],
                        "if_operator" => $selectedField['if_operator'],
                        "if_value" => $selectedField['if_value'],
                        "else_value" => $selectedField['else_value'],
                    ]);
                }
                $this->emitSelf('refreshComponent');
                $this->refreshData();
                $this->emitTo('selection-filters', 'resetAll');
                $this->emit('saved');
            }

        } catch (Exception $e) {
            session()->flash("error", $e->getCode() . ": " . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.selection-if-filters');
    }
}
