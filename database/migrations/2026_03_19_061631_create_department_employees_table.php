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
        Schema::create('department_employees', function (Blueprint $table) {
            $table->bigIncrements('id_no');
            $table->foreignId('emp_no')
                ->references('emp_no')
                ->on('employees')
                ->restrictOnDelete();
            $table->foreignId('dept_no')
                ->references('dept_no')
                ->on('departments')
                ->restrictOnDelete();
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_employees');
    }
};
