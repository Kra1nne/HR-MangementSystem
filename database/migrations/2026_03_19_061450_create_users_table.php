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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')
                ->unique()
                ->constrained('persons')
                ->restrictOnDelete();
            $table->string('email')
                ->unique();
            $table->text('password');
            $table->string('role', 100);
            $table->string('otp', 6)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('status_request', 50);
            $table->timestamp('otp_validity')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
