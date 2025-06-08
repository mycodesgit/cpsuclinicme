<?php

namespace App\Models\ClinicDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;
    protected $table='patients';
    protected $fillable = [
        'stid',
        'stdntid',
        'lname',
        'fname',
        'mname',
        'ext_name',
        'category',
        'birthdate',
        'age',
        'sex',
        'home_region',
        'home_province',
        'home_city',
        'home_brgy',
        'contact',
        'stud_nation',
        'stud_religion',
        'c_status',
        'studCollege',
        'studCourse',
        'office',
        'guardian',
        'guardian_occup',
        'guardian_contact',
        'guardian_region',
        'guardian_province', 
        'guardian_city',
        'guardian_brgy',
        'height_cm',
        'height_ft',
        'weight_kg',
        'weight_lb',
        'bmi',
        'temp',
        'pr',
        'bp',
        'rr',
        'disease',
        'disease_rem',
        'hospital_confine',
        'date_hospitaliz',
        'date_hospitaliz1',
        'immunization1',
        'immunization2',
        'smoking',
        'drinking',
        'Menarche',
        'Duration',
        'Interval',
        'pads_use',
        'mens_symp',
        'lmp',
        'en_pexam',
        'findings_pexam',
        'other_pexam',
        'other_find',
        'pexam_pwd',
        'pexam_remarks',
        'pend_reason'
    ];

    public function patientVisits()
    {
        return $this->hasMany(Patientvisit::class, 'stid');
    }
}