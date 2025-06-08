<?php

namespace App\Models\ClinicDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
     protected $fillable =['medicine','qty'];
     protected $table='medicines';  


public function patientVisit()
    {
        return $this->hasMany(PatientVisit::class, 'id');
    }
}