<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectionIfFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selection_if_filters', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->string('parent_uuid');
            $table->string('parent_table_name');
            $table->string('if_uuid');
            $table->string('if_name');
            $table->string('if_auto_name');
            $table->string('if_type');
            $table->integer('if_level');
            $table->string('if_field');
            $table->string('if_operator');
            $table->string('if_condition');
            $table->text('if_value')->nullable();
            $table->text('else_value')->nullable(0);
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
        Schema::dropIfExists('selection_if_filters');
    }
}
