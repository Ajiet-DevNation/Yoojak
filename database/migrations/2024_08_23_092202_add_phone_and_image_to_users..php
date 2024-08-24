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
        Schema::table('users', function (Blueprint $table) {
            $table->string('usn')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('image')->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->enum('branch',['CSE', 'ISE', 'ECE', 'ME', 'CV', 'AIML', 'AIDS', 'ICB','OTHER'])->default('OTHER');
            $table->string('batch')->nullable();
            $table->float('cgpa')->nullable();
            $table->string('current_sem')->nullable();
            $table->float('twelthPercentage')->nullable();
            $table->float('tenthPercentage')->nullable();
            $table->float('diplomaPercentage')->nullable();
            $table->integer('backlogs')->default(0);
            $table->dateTime('dob')->nullable();
            $table->enum('gender', ['male', 'female', 'transgender', 'OTHER'] )->default('OTHER');
            $table->string('resume')->nullable();
            $table->string('twelthCertificate')->nullable();
            $table->string('tenthCertificate')->nullable();
            $table->string('diplomaCertificate')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
