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
        Schema::create('department_managers', function (Blueprint $table) {
            $table->foreignId('emp_no')
                ->references('emp_no')
                ->on('employees')
                ->constrained();
            $table->foreignId('dept_no')
                ->references('dept_no')
                ->on('departments')
                ->constrained();
            $table->date('from_date');
            $table->string('status', 100);
            $table->date('to_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_managers');
    }
};
