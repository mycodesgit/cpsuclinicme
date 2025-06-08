<?php

namespace App\Models\ClinicDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patientvisit extends Model
{
    use HasFactory;
    protected $table ='patientvisits';

    protected $fillable=[
        'date',
        'time',
        'stid',
        'contact',
        'chief_complaint'
    ];
   
    public function patients()
    {
        return $this->belongstomany(Patients::class, 'id');
    } 

    public function medicines()
    {
        return $this->belongstomany(Medicine::class, 'id');
    }
}

