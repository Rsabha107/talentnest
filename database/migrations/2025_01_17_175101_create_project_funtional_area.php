<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_funtional_area', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('project_id')->unseigned();
            $table->unsignedBigInteger('functional_area_id')->unseigned();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('functional_area_id')->references('id')->on('functional_areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_funtional_area');
    }
};
