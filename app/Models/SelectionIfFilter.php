<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SelectionIfFilter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "parent_id",
        "parent_uuid",
        "parent_table_name",
        "if_type",
        "if_field",
        "if_uuid",
        "if_level",
        "if_type",
        "if_name",
        "if_auto_name",
        "if_condition",
        "if_operator",
        "if_value",
        "else_value",
    ];
}
