<?php

namespace App\Http\Livewire;

use App\Models\ExcelStore;
use App\Models\SelectionFilter;
use Livewire\Component;
use Illuminate\Support\Str;

class SelectionFilterGroups extends Component
{
    public $params;
    public $startMountValue = false;
    public $group_id,
        $criteria_condition,
        $criteria_operator,
        $criteria_group_uuid,
        $criteria_group_auto_name,
        $criteria_group_name,
        $criteria_group_level,
        $criteria_group_type;
    public $selectedGroupFields = [];
    public $allGroupFields = [];

    protected $listeners = [
        'submitData' => 'submit',
        'editData' => 'editGroupField',
        'refreshData',
        'refreshComponent' => '$refresh',
        ];
    protected $rules = [
        'group_id' => 'nullable|integer',
        'criteria_condition' => 'required|string',
        'criteria_operator' => 'required|string',
        'criteria_group_uuid' => 'required|string',
        'criteria_group_level' => 'required|integer',
        'criteria_group_type' => 'required|string',
        'criteria_group_name' => 'required|string',
        'criteria_group_auto_name' => 'nullable|string',
        'selectedGroupFields.*.id' => 'integer',
        'selectedGroupFields.*.parent_id' => 'required|integer',
        'selectedGroupFields.*.parent_uuid' => 'required|string',
        'selectedGroupFields.*.parent_table_name' => 'required|string',
        'selectedGroupFields.*.criteria_type' => 'required|string',
        'selectedGroupFields.*.criteria_group_uuid' => 'nullable|string',
        'selectedGroupFields.*.criteria_group_level' => 'nullable|integer',
        'selectedGroupFields.*.criteria_group_type' => 'nullable|string',
        'selectedGroupFields.*.criteria_group_name' => 'nullable|string',
        'selectedGroupFields.*.criteria_group_auto_name' => 'nullable|string',
        'selectedGroupFields.*.criteria_field' => 'nullable|required|string',
        'selectedGroupFields.*.criteria_condition' => 'nullable|required|string',
        'selectedGroupFields.*.criteria_operator' => 'nullable|required|string',
        'selectedGroupFields.*.criteria_value' => 'required|string',
    ];

    public function mount()
    {
        $this->reset(['allGroupFields', 'selectedGroupFields']);

        $this->criteria_condition = is_null($this->criteria_condition) ? 'and' : $this->criteria_condition;
        $this->criteria_operator = is_null($this->criteria_operator) ? '!=' : $this->criteria_operator;
        $this->criteria_group_uuid = is_null($this->criteria_group_uuid) ? Str::orderedUuid()->toString() : $this->criteria_group_uuid;
        $this->criteria_group_auto_name = is_null($this->criteria_group_auto_name) ? 'group_'.Str::random(20) : $this->criteria_group_auto_name;
        $this->criteria_group_name = is_null($this->criteria_group_name) ? '' : $this->criteria_group_name;
        $this->criteria_group_level = is_null($this->criteria_group_level) ? 0 : $this->criteria_group_level;
        $this->criteria_group_type = is_null($this->criteria_group_type) ? 'parent' : $this->criteria_group_type;
        $this->group_id = is_null($this->group_id) ? null : $this->group_id;
        if(!is_null($this->params[0])) {
            $field = json_decode(ExcelStore::find($this->params[0])->value('excel_file_header'), true);
            $selectedFieldsValues = SelectionFilter::where('parent_id', '=', $this->params[0])
                ->where('criteria_group_uuid', '=', $this->criteria_group_uuid)
                ->orderBy('id', 'asc')->get();
            $selectedFieldsValues = sizeof($selectedFieldsValues) > 0 ? $selectedFieldsValues : [[
                "id" => "",
                "parent_id" => $this->params[0],
                "parent_uuid" => $this->params[1],
                "parent_table_name" => $this->params[2],
                "criteria_type" => "qualificationGroup",
                "criteria_group_uuid" => $this->criteria_group_uuid,
                "criteria_group_level" => "1",
                "criteria_group_type" => "child",
                "criteria_group_name" => $this->criteria_group_name,
                "criteria_group_auto_name" => $this->criteria_group_auto_name,
                "criteria_field" => "",
                "criteria_condition" => "and",
                "criteria_operator" => "!=",
                "criteria_value" => "",
            ]];

            $this->allGroupFields = $field[0][0];
            $this->selectedGroupFields = $selectedFieldsValues;
        }
    }

    public function startMount(){
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->reset(['allGroupFields', 'selectedGroupFields']);
        $field = json_decode(ExcelStore::find($this->params[0])->value('excel_file_header'), true);
        $selectedFieldsValues = SelectionFilter::where('parent_id','=',$this->params[0])
            ->where('criteria_group_uuid','=',$this->criteria_group_uuid)
            ->where('criteria_group_level','=',1)
            ->orderBy('id', 'asc')->get();
        $selectedId = SelectionFilter::where('parent_id','=',$this->params[0])
            ->where('criteria_group_uuid','=',$this->criteria_group_uuid)
            ->where('criteria_group_level','=',0)
            ->value('id');

        $selectedFieldsValues = sizeof($selectedFieldsValues) > 0 ? $selectedFieldsValues : [[
            "id" => "",
            "parent_id" => $this->params[0],
            "parent_uuid" => $this->params[1],
            "parent_table_name" => $this->params[2],
            "criteria_type" => "qualificationGroup",
            "criteria_group_uuid" => $this->criteria_group_uuid,
            "criteria_group_level" => "1",
            "criteria_group_type" => "child",
            "criteria_group_name" => $this->criteria_group_name,
            "criteria_group_auto_name" => $this->criteria_group_auto_name,
            "criteria_field" => "",
            "criteria_condition" => "and",
            "criteria_operator" => "!=",
            "criteria_value" => "",
        ]];

        $this->allGroupFields = $field[0][0];
        $this->group_id = $selectedId;
        $this->selectedGroupFields = $selectedFieldsValues;
        $this->emitTo('selection-filters', 'refreshData');
    }

    function is_collection($param): bool
    {
        return (bool) (($param instanceof \Illuminate\Support\Collection) || ($param instanceof \Illuminate\Database\Eloquent\Collection));
    }

    public function addGroupField()
    {
//        dd('here');
        $type = $this->is_collection($this->selectedGroupFields);
        $collection = null;
        if($type){
            $collection = collect([
                "id" => "",
                "parent_id" => $this->params[0],
                "parent_uuid" => $this->params[1],
                "parent_table_name" => $this->params[2],
                "criteria_type" => "qualificationGroup",
                "criteria_group_uuid" => $this->criteria_group_uuid,
                "criteria_group_level" => "1",
                "criteria_group_type" => "child",
                "criteria_group_name" => $this->criteria_group_name,
                "criteria_group_auto_name" => $this->criteria_group_auto_name,
                "criteria_field" => "",
                "criteria_condition" => "and",
                "criteria_operator" => "!=",
                "criteria_value" => "",
            ]);
            $this->selectedGroupFields[] = $collection;
            $this->selectedGroupFields = $this->selectedGroupFields->toArray();
        } else {
            $collection = [
                "id" => "",
                "parent_id" => $this->params[0],
                "parent_uuid" => $this->params[1],
                "parent_table_name" => $this->params[2],
                "criteria_type" => "qualificationGroup",
                "criteria_group_uuid" => $this->criteria_group_uuid,
                "criteria_group_level" => "1",
                "criteria_group_type" => "child",
                "criteria_group_name" => $this->criteria_group_name,
                "criteria_group_auto_name" => $this->criteria_group_auto_name,
                "criteria_field" => "",
                "criteria_condition" => "and",
                "criteria_operator" => "!=",
                "criteria_value" => "",
            ];
            $this->selectedGroupFields[] = $collection;
        }
    }

    public function editGroupField($keys,$id, $groupUUID){
//        dd($this->params[0]);
        $field = json_decode(ExcelStore::find($this->params[0])->value('excel_file_header'), true);
        $selectedFieldsValues = SelectionFilter::where('parent_id','=',$this->params[0])
            ->where('criteria_group_uuid','=',$groupUUID)
            ->where('criteria_group_level','=',1)
            ->orderBy('id', 'asc')->get();
//        $selectedId = SelectionFilter::where('parent_id','=',$this->params[0])
//            ->where('criteria_group_uuid','=',$this->criteria_group_uuid)
//            ->where('criteria_group_level','=',0)
//            ->value('id');
//
        $selectedFieldsValues = sizeof($selectedFieldsValues) > 0 ? $selectedFieldsValues : [[
            "id" => "",
            "parent_id" => $this->params[0],
            "parent_uuid" => $this->params[1],
            "parent_table_name" => $this->params[2],
            "criteria_type" => "qualificationGroup",
            "criteria_group_uuid" => $this->criteria_group_uuid,
            "criteria_group_level" => "1",
            "criteria_group_type" => "child",
            "criteria_group_name" => $this->criteria_group_name,
            "criteria_group_auto_name" => $this->criteria_group_auto_name,
            "criteria_field" => "",
            "criteria_condition" => "and",
            "criteria_operator" => "!=",
            "criteria_value" => "",
        ]];

        $this->allGroupFields = $field[0][0];
        $this->group_id = $id;
        $this->selectedGroupFields = $selectedFieldsValues;
        $this->emit('openGroupModal');
    }

    public function deletedGroupField($keys,$id)
    {
        unset($this->selectedGroupFields[$keys]);
        $this->selectedGroupFields = array_values($this->selectedGroupFields->toArray());
        if($id != null)
        {
            $model = SelectionFilter::find( $id );
            $model->delete();
        }

    }

    public function submit()
    {

        $this->validate();

        try {

            if(is_null($this->group_id) || $this->group_id == ""){
                SelectionFilter::create([
                    "id" => "",
                    "parent_id" => $this->params[0],
                    "parent_uuid" => $this->params[1],
                    "parent_table_name" => $this->params[2],
                    "criteria_type" => "qualificationGroupParent",
                    "criteria_group_uuid" => $this->criteria_group_uuid,
                    "criteria_group_level" => "0",
                    "criteria_group_type" => "parent",
                    "criteria_group_name" => $this->criteria_group_name,
                    "criteria_group_auto_name" => $this->criteria_group_auto_name,
                    "criteria_field" => $this->criteria_group_name,
                    "criteria_condition" => $this->criteria_condition,
                    "criteria_operator" => "GROUP",
                    "criteria_value" => "NONE",
                    ]);
            } else {
                SelectionFilter::find($this->group_id)->update([
                    "criteria_group_name" => $this->criteria_group_name,
                    "criteria_condition" => $this->criteria_condition,
                    "criteria_field" => $this->criteria_group_name,
                    "criteria_operator" => "GROUP",
                    "criteria_value" => "NONE",
                ]);
            }

            foreach($this->selectedGroupFields as $key => $selectedField)
            {
                if($selectedField['id'] == "") {
                    SelectionFilter::create([
                        "parent_id" => $selectedField['parent_id'],
                        "parent_uuid" => $selectedField['parent_uuid'],
                        "parent_table_name" => $selectedField['parent_table_name'],
                        "criteria_type" => $selectedField['criteria_type'],
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
        return view('livewire.selection-filter-groups');
    }
}
