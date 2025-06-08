<?php

namespace App\Models\ClinicDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'course';

    protected $fillable = [
        'campus',
        'progName', 
        'progDep', 
        'progCollege',
        'progAcronym',
    ];
}
