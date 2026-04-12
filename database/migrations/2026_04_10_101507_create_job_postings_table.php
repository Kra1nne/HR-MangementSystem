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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dept_no')
                ->references('dept_no')
                ->on('departments')
                ->constrained()
                ->restrictOnDelete();
            $table->foreignId('created_by')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->string('job_title');
            $table->text('description');
            $table->text('objectives');
            $table->text('requirements');
            $table->integer('salary');
            $table->string('position');
            $table->string('employment_type');
            $table->string('work_setup');
            $table->string('location');     
            $table->enum('status', ['draft', 'open', 'closed'])->default('draft');
            $table->timestamp('posted_at')->nullable();
            $table->timestamp('closing_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
