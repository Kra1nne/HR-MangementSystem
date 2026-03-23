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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('emp_no');
            $table->foreignId('person_id')
                ->unique()
                ->constrained('persons')
                ->restrictOnDelete();
            $table->string('emp_id', 100);
            $table->date('hire_date');
            $table->date('to_date')->nullable();
            $table->string('status', 50);
            $table->text('face_descriptor')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
