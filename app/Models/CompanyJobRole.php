<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyJobRole extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'job_role',
        'description',
        'vacancies',
        'salary',
        'location',
        'start_date',
        'end_date',
    ];  
}
