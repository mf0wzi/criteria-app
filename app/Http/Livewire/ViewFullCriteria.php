<?php

namespace App\Http\Livewire;

use App\Models\GetExcelUpload;
use App\Models\SelectionFilter;
use App\Models\SelectionIfFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ViewFullCriteria extends LivewireDatatable
{
    public $params, $header, $dataColumns;
    public $count, $count2 = 0;
    protected $data;
    public $hideable = 'select';
    public $exportable = true;

    public function builder()
    {
        $filters = SelectionFilter::all()
            ->where('parent_id','=',$this->params[0])
            ->where('criteria_group_level','<>',1)
            ->where('criteria_group_type','<>','parent')
            ->sortBy('id');
        $filtersGroup = SelectionFilter::all()
            ->where('parent_id','=',$this->params[0])
            ->where('criteria_group_level','<>',1)
            ->where('criteria_group_type','=','parent')
            ->sortBy('id');
        $queryGetExcel = (new GetExcelUpload())
            ->setTable($this->params[2])
            ->newQuery()
            ->where('id', '<>', 1);
        $where = $this->getWhere($filters);
        $filteredData = $this->getData($where,$filtersGroup, $queryGetExcel);

        return  $filteredData;
    }

    public function getWhere($filters)
    {

        $where = function (Builder $query) use ($filters) {
            $filters
                ->each(function ($value, $param) use ($query) {

                    if ($value->criteria_condition == 'or' && $param != 0) {
                        $query->orWhere(function (Builder $query) use ($value) {
                            if($value->criteria_group_type == 'parent') {
                                $this->getGroupWhere($value);
                            } else {
                                $this->getType($query, $value);
                            }
                        });
                    } else {
                        $query->where(function (Builder $query) use ($value) {
                            if($value->criteria_group_type == 'parent') {
                                $this->getGroupWhere($value);
                            } else {
                                $this->getType($query, $value);
                            }
                        });
                    }
                });
        };
        return $where;
    }

    public function getGroupWhere($groupValue)
    {
        $filtersGroup = SelectionFilter::all()
            ->where('criteria_group_uuid','=',$groupValue->criteria_group_uuid)
            ->where('criteria_group_level','=',1)
            ->sortBy('id');

        return function (Builder $query) use ($groupValue, $filtersGroup) {

            $filtersGroup
                ->each(function ($value, $param) use ($query) {

                    if ($value->criteria_condition === 'or' && $param !== 0) {
                        $query->orWhere(function (Builder $query) use ($value) {
                            $this->getType($query, $value);
                        });
                    } else {
                        $query->where(function (Builder $query) use ($value) {
                            $this->getType($query, $value);
                        });
                    }
                });
        };
    }

    public function getType(Builder $query, $values)
    {
        $array = array();
        switch ($values->criteria_operator) {
            case "!=":
            case ">":
            case "<":
            case "=>":
            case "<=":
                return $query->where($values->criteria_field, $values->criteria_operator, $values->criteria_value);
                break;
            case "NOT BETWEEN":
                $array = explode(",", $values->criteria_value);
                $searchValues = $this->getNumeric($array);
                return $query->whereNotBetween($values->criteria_field, $searchValues);
                break;
            case "NOT IN":
                $array = explode(",", $values->criteria_value);
                $searchValues = $this->getNumeric($array);
                return $query->whereNotIn($values->criteria_field, $searchValues);
                break;
            case "NOT NULL":
                return $query->whereNotNull($values->criteria_field);
                break;
            default:
                return $query->where($values->criteria_field, $values->criteria_operator, $values->criteria_value);
        }
    }

    public function getData(\Closure $where, $group, $queryGetExcel)
    {
        $queryGetExcel->where($where);
        $group->each(function ($value, $param) use ($queryGetExcel) {
            if($param !== 0){
                $groupWhere = $this->getGroupWhere($value);
                if($value->criteria_condition === 'or' && $param != 0){
                    $queryGetExcel->orWhere($groupWhere);
                } else {
                    $queryGetExcel->where($groupWhere);
                }
            }
        });
        $queryGetExcel->where('id','!=', 1)->groupBy('id');
        return $queryGetExcel;
    }

    public function getIfData($columns)
    {

        $filtersParentIf = SelectionIfFilter::all()
            ->where('parent_id','=',$this->params[0])
            ->where('if_level','<>',1)
            ->where('if_type','=','parent')
            ->sortBy('id');
        if($filtersParentIf->isEmpty() === false) {

            $if_collection = array();
            $total_value = null;

            $filtersParentIf
                ->each(function ($value, $key) use (&$columns, &$if_collection) {
                    $ifString = $this->getIfChild($value->if_uuid);
                    $if_value = $this->getValueType($value->if_value);
                    $else_value = $this->getValueType($value->else_value);
                    $columns[] = Column::raw("IF($ifString, $if_value ,$else_value) AS $value->if_name")
                        ->label($value->if_name)
                        ->searchable()
                        ->truncate(100)
                        ->filterable()
                        ->alignCenter();
                    $if_collection[] = "IF($ifString, $if_value ,$else_value) ";

                });

            if (is_array($if_collection)) {

                foreach ($if_collection as $k => &$value) {
                    if ($this->count < 1) {
                        $total_value .= (string)$value;
                    } else {
                        $total_value .= "+ $value";
                    }

                    $this->count++;
                }
                $this->count = 0;
                $columns[] = Column::raw("SUM($total_value) AS Total")
                    ->label('Total')
                    ->searchable()
                    ->truncate(100)
                    ->filterable()
                    ->alignCenter();
            }
        }
        return $columns;
    }

    public function getIfChild($uuid): string
    {

        $filtersChildIf = SelectionIfFilter::all()
            ->where('if_uuid', '=', $uuid)
            ->where('if_level', '=', 1)
            ->where('if_type', '=', 'child')
            ->sortBy('id');
        $if_string = array();

        $filtersChildIf->each(function ($value, $key) use (&$if_string){
            $if_value = $this->getValueType($value->if_value);
            if($this->count < 1) {

                $if_string[] = "$value->if_field $value->if_operator $if_value";
            } else {

                $if_string[] = " $value->if_condition $value->if_field $value->if_operator $if_value";
            }
            $this->count++;

        });
        $this->count = 0;

        return implode('',$if_string);
    }

    public function getNumeric($vals): array
    {
        $array = array();
        foreach($vals as $val){
            if (is_numeric($val)) {
                $array[] = $val + 0;
            } else {
                $array[] = $val;
            }
        }
        return $array;
    }

    public function getValueType($vals){
        $value = null;
        if (is_numeric($vals)) {
            $value = $vals + 0;
        } else if(is_string($vals)) {
            $value = "'".$vals."'";
        }
        return $value;
    }

    public function columns()
    {

        $columns = [
            NumberColumn::name('id')
                ->defaultSort('asc')
                ->label('ID')
                ->hide(),
        ];
        $columns = $this->getIfData($columns);
        foreach ($this->params[3][0][0] as $keys => &$value) {

            $columns[] = Column::name($keys)
                ->label($value)
                ->searchable()
                ->truncate(100)
                ->filterable()
                ->alignCenter();

        }
        return $columns;
    }
}
