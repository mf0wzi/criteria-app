<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SelectionFilter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "parent_id",
        "parent_uuid",
        "parent_table_name",
        "criteria_type",
        "criteria_field",
        "criteria_group_uuid",
        "criteria_group_level",
        "criteria_group_type",
        "criteria_group_name",
        "criteria_group_auto_name",
        "criteria_condition",
        "criteria_operator",
        "criteria_value",
    ];
}
