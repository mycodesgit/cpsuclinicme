<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\ClinicDB\Patients;
use App\Models\ClinicDB\Course;
use App\Models\ClinicDB\Office;

use App\Models\EnrollmentDB\StudEnrolmentHistory;
use App\Models\EnrollmentDB\Student;

use App\Models\ScheduleDB\College;
use App\Models\ScheduleDB\EnPrograms;

use App\Models\SettingDB\ConfigureCurrent;
use App\Models\SettingDB\Region;
use App\Models\SettingDB\Province;
use App\Models\SettingDB\City;
use App\Models\SettingDB\Barangay;

class PatientUpcomingController extends Controller
{
    public function studentUpcomingRead() 
    {
        $sy = ConfigureCurrent::select('id', 'schlyear')
            ->whereIn('id', function($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('settings_conf')
                    ->groupBy('schlyear');
            })
            ->orderBy('id', 'DESC')
            ->get();

        return view('patient.upcoming', compact('sy'));
    }

    public function getStudentUpcomingData(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $data = Patients::whereYear('patients.created_at', $currentYear)
            ->whereMonth('patients.created_at', '>=', $currentMonth)
            ->select('patients.*')
            ->orderBy('patients.created_at', 'ASC')
            ->get()
            ->map(function ($patient) {
                return [
                    'id' => Crypt::encryptString($patient->id),
                    'fname' => $patient->fname,
                    'lname' => $patient->lname,
                    'mname' => $patient->mname,
                    'sex' => $patient->sex,
                    'c_status' => $patient->c_status,
                ];
            });
        
        return response()->json(['data' => $data]);
    }

    public function moreInfoupcoming($id)
    {
        $decryptedId = Crypt::decryptString($id);
        
        $patients = Patients::where('id', $decryptedId)->first();
        $regions = Region::all();
        $hprovinces = Province::where('region_id', $patients->home_region)->get();
        $hcities = City::where('city_id', $patients->home_city)->get();
        $hbarangays = Barangay::find($patients->home_brgy);

        $gprovinces = Province::where('region_id', $patients->guardian_region)->get();
        $gcities = City::where('city_id', $patients->guardian_city)->get();
        $gbarangays = Barangay::find($patients->guardian_brgy);

        $campus = Auth::guard('web')->user()->campus;

        $campusArray = array_map('trim', explode(',', $campus));

        $col = College::whereIn('id', [2, 3, 4, 5, 6, 7, 8])
                ->get();

        // $offices = Office::all();
   
        if (is_null($id)) {
            return redirect()->back()->with('error', 'ID cannot be null.');
        }
        return view('patient.patient_moreinfo', compact(
                                                'patients', 
                                                'regions', 
                                                'hprovinces', 
                                                'hcities', 
                                                'hbarangays', 
                                                'gbarangays', 
                                                'gprovinces', 
                                                'gcities', 
                                                'gbarangays', 
                                                'col'));
    }
}
