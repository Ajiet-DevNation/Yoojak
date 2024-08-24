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
        Schema::create('placed_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDeleteCascade();
            $table->foreignId('user_id')->constrained('users')->onDeleteCascade();
            $table->foreignId('job_role_id')->constrained('company_job_roles')->onDeleteCascade();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placed_students');
    }
};
