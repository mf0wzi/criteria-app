<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectionFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selection_filters', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->string('parent_uuid');
            $table->string('parent_table_name');
            $table->string('criteria_type');
            $table->string('criteria_field');
            $table->string('criteria_group_uuid')->nullable();
            $table->integer('criteria_group_level')->nullable();
            $table->string('criteria_group_type')->nullable();
            $table->string('criteria_group_name')->nullable();
            $table->string('criteria_group_auto_name')->nullable();
            $table->string('criteria_operator');
            $table->string('criteria_condition');
            $table->text('criteria_value');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selection_filters');
    }
}
