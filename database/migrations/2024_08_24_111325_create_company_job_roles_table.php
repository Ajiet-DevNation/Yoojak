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
        Schema::create('company_job_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDeleteCascade();
            $table->string('job_title');
            $table->string('job_description');
            $table->enum('job_type',['Full Time','Part Time','Internship'])->default('Full Time');
            $table->string('job_location');
            $table->string('job_salary');
            $table->string('job_experience');
            $table->string('job_qualification');
            $table->longText('job_skills');
            $table->integer('job_vacancy');
            $table->float('min_cgpa');
            $table->integer('min_backlogs')->default(0);
            $table->float('tenth_min_percentage');
            $table->float('twelth_min_percentage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_job_roles');
    }
};
