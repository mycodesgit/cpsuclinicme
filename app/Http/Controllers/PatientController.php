<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

class PatientController extends Controller
{
    
    public function patientAdd() 
    {
        $regions = Region::all();
        $col = College::whereIn('id', [2, 3, 4, 5, 6, 7, 8])->get();
        $prog = EnPrograms::orderBy('progAcronym', 'ASC')->get();
        $patients = Patients::all();
        
        //$offices = Office::all();
        return view('patient.patient_add', compact('patients', 'regions', 'col', 'prog'));
    }
    
    public function studentRead() 
    {
        $sy = ConfigureCurrent::select('id', 'schlyear')
            ->whereIn('id', function($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('settings_conf')
                    ->groupBy('schlyear');
            })
            ->orderBy('id', 'DESC')
            ->get();

        return view('patient.students', compact('sy'));
    }

    public function studentShow(Request $request) 
    {
        $campus = $request->query('campus');
        $schlyear = $request->query('schlyear');
        $semester = $request->query('semester');

        $sy = ConfigureCurrent::select('id', 'schlyear')
            ->whereIn('id', function($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('settings_conf')
                    ->groupBy('schlyear');
            })
            ->orderBy('id', 'DESC')
            ->get();
    

        return view('patient.students_listsearch', compact('sy', 'campus'));
    }

    public function getStudentData(Request $request)
    {
        $campus = $request->query('campus');
        $schlyear = $request->query('schlyear');
        $semester = $request->query('semester');

        $campusArray = array_map('trim', explode(',', $campus));

        $data = Student::join('program_en_history', 'students.stud_id', '=', 'program_en_history.studentID')
            ->join('coasv2_db_schedule.programs', 'program_en_history.progCod', '=', 'coasv2_db_schedule.programs.progCod')
            ->where('program_en_history.schlyear', $schlyear)
            ->where('program_en_history.semester', $semester)
            ->where('program_en_history.status', 2)
            ->where(function ($q) use ($campusArray) {
                foreach ($campusArray as $campus) {
                    $q->orWhere('program_en_history.campus', 'LIKE', "$campus");
                }
            })
            ->where(function ($q) use ($campusArray) {
                foreach ($campusArray as $campus) {
                    $q->orWhere('students.campus', 'LIKE', "%$campus%");
                }
            })
            ->where('students.stud_id', 'NOT LIKE', '%-G%')
            ->select(
                'students.*',
                'program_en_history.schlyear',
                'program_en_history.semester',
                'program_en_history.status',
                'program_en_history.progCod',
                'program_en_history.campus as peh_campus',
                'coasv2_db_schedule.programs.progAcronym',
                'coasv2_db_schedule.programs.progName'
            )
            ->orderBy('students.lname', 'ASC')
            ->groupBy('students.stud_id', 'program_en_history.progCod', 'program_en_history.schlyear', 'program_en_history.semester', 'program_en_history.status', 'program_en_history.campus')
            //->limit(10)
            ->get();
    
        return response()->json(['data' => $data]);
    }

    public function moreInfo($id)
    {
        
        $patients = Patients::where('id', $id)->first();
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
        return view('patient.patient_moreinfo', compact('patients', 'regions', 'hprovinces', 'hcities', 'hbarangays', 'gbarangays', 'gprovinces', 'gcities', 'gbarangays', 'col'));
    }

    public function patientCreate(Request $request)
    {
        $request->validate([
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'birthdate' => 'required',
            'age' => 'required',
            'sex' => 'required',
            'category' => 'required',
            'home_region' => 'required',
            'home_province' => 'required',
            'home_city' => 'required',
            'home_brgy' => 'required',
            'contact' => 'required',
            'stud_nation' => 'required',
            'stud_religion' => 'required',
            'c_status' => 'required',
            'studCollege' => 'nullable',
            'studCourse' => 'nullable',
            'office' => 'nullable',
            'guardian' => 'required',
            'guardian_occup' => 'required',
            'guardian_contact' => 'required',
            'guardian_region' => 'required',
            'guardian_province' => 'required',
            'guardian_city' => 'required',
            'guardian_brgy' => 'required',
            'height_cm' => 'required',
            'height_ft' => 'required',
            'weight_kg' => 'required',
            'weight_lb' => 'required',
            'bmi' => 'required',
            'temp' => 'nullable',
            'pr' => 'nullable',
            'bp' => 'nullable',
            'rr' => 'nullable',
        ]);
    
        $patient = Patients::create([
            'campus' => Auth::guard('web')->user()->campus,
            'lname' => $request->input('lname'),
            'fname' => $request->input('fname'),
            'mname' => $request->input('mname'),
            'ext_name' => $request->input('ext_name'),
            'birthdate' => $request->input('birthdate'),
            'age' => $request->input('age'),
            'sex' => $request->input('sex'),
            'category' => $request->input('category'),
            'home_region' => $request->input('home_region'),
            'home_province' => $request->input('home_province'),
            'home_city' => $request->input('home_city'),
            'home_brgy' => $request->input('home_brgy'),
            'contact' => $request->input('contact'),
            'stud_nation' => $request->input('stud_nation'),
            'stud_religion' => $request->input('stud_religion'),
            'c_status' => $request->input('c_status'),
            'studCollege' => $request->input('studCollege'),
            'studCourse' => $request->input('studCourse'),
            'office' => $request->input('office'),
            'guardian' => $request->input('guardian'),
            'guardian_occup' => $request->input('guardian_occup'),
            'guardian_contact' => $request->input('guardian_contact'),
            'guardian_region' => $request->input('guardian_region'),
            'guardian_province' => $request->input('guardian_province'),
            'guardian_city' => $request->input('guardian_city'),
            'guardian_brgy' => $request->input('guardian_brgy'),
            'height_cm' => $request->input('height_cm'),
            'height_ft' => $request->input('height_ft'),
            'weight_kg' => $request->input('weight_kg'),
            'weight_lb' => $request->input('weight_lb'),
            'bmi' => $request->input('bmi'),
            'temp' => $request->input('temp'),
            'pr' => $request->input('pr'),
            'bp' => $request->input('bp'),
            'rr' => $request->input('rr'),
        ]);
    
        //return redirect()->back()->with('success', 'Added Successfully');
        return redirect()->route('moreInfoupcoming', $patient->id)->with('success', 'Added Successfully');
    }

    public function getCollege(Request $request)
    {
        $selectedCampus = $request->input('campus');

        $college = EnPrograms::where('campus', $selectedCampus)->get();

        return response()->json(['college' => $college]);
    }

    public function getCourse(Request $request)
    {
        $selectedCollege = $request->input('studCollege');

        $course = EnPrograms::where('progCollege', $selectedCollege)->get();

        return response()->json(['course' => $course]);
    }

    // public function getStudentData(Request $request)
    // {
    //     $campus = $request->query('campus');
    //     $schlyear = $request->query('schlyear');
    //     $semester = $request->query('semester');

    //     $campusArray = array_map('trim', explode(',', $campus));

    //     $programEnQuery = DB::connection('enrollment')
    //         ->table('program_en_history')
    //         ->select('studentID')
    //         ->where('schlyear', $schlyear)
    //         ->where('semester', $semester)
    //         ->where(function ($q) use ($campusArray) {
    //                     foreach ($campusArray as $campus) {
    //                         $q->orWhere('campus', 'LIKE', "%$campus%");
    //                     }
    //                 });

    //     $data = DB::table('patients')
    //         ->joinSub($programEnQuery, 'prog', function ($join) {
    //             $join->on('patients.stdntid', '=', 'prog.studentID');
    //         })
    //         ->where(function ($q) use ($campusArray) {
    //                     foreach ($campusArray as $campus) {
    //                         $q->orWhere('patients.campus', 'LIKE', "%$campus%");
    //                     }
    //                 })
    //         ->where('patients.stdntid', 'NOT LIKE', '%-G%')
    //         ->select('patients.*')
    //         ->orderBy('patients.lname', 'asc')
    //         ->get();
    
    //     return response()->json(['data' => $data]);
    // }

    // public function patientRead($id) 
    // {
    //     //$col = Program::where('campus', '=', Auth::user()->campus)->get();
    //    // $patients = Patients::where('category', $id)->get();
    //     $patients = Patients::where('category', $id)->limit(10)->get();
    //     $sy = ConfigureCurrent::select('id', 'schlyear')
    //         ->whereIn('id', function($query) {
    //             $query->select(DB::raw('MAX(id)'))
    //                 ->from('settings_conf')
    //                 ->groupBy('schlyear');
    //         })
    //         ->orderBy('id', 'DESC')
    //         ->get();

    //     return view('patient.patient_list', compact('patients', 'sy'));
    // }

    public function patientData($id)
    {
        $patients = Patients::where('category', $id)
            ->select('id', 'age', 'sex', 'c_status', 'pexam_remarks', 
                     \DB::raw("CONCAT(lname, ' ', fname, ' ', IFNULL(ext_name, ''), ' ', IFNULL(mname, '')) as full_name"))
            ->get();
    
        return response()->json(['data' => $patients]);
    }

    

    

    public function getJsonData($studid)
    {
        $data = [
            'stud_id' => '2501-0691-G',
            'fname' => 'Edwin',
            'mname' => 'Trio',
            'lname' => 'Abril',
            'ext_name' => 'Jr',
            'birthdate' => '2003-06-17',
            'age' => '21',
            'sex' => 'Male',
            'contact' => '09063084301',
            'c_status' => 'Single',
            'studCollege' => 'progCollege',
            'studCourse' => 'progAcronym',
            'yearLevel' => '1',
            'guardian' => 'Phebe Abril',
        ];
        
        $response = Http::post('http://localhost/cpsuclinic/public/patient/create-json', [
            'data' => json_encode($data)
        ]);
    
        return $response->json();
    }
    
    public function createJson(Request $request)
    {
        $jsonData = $request->query('data');

        $data = json_decode($jsonData, true);

        Patient::create($data);

        return view('patient.create', ['data' => $data]);
    }

    public function patientUpdate(Request $request)
    {
        $patient = Patients::findOrFail($request->id);
        $column = $request->column;
        if ($column == 'birthdate') {
            $birthdate = Carbon::parse($request->value);
            $age = $birthdate->age;
            $patient->update([
                $column => $request->value,
                'age' => $age
            ]);
        } else {
            $patient->update([
                $column => $request->value
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function patientHistory(Request $request)
    {
        $patient = Patients::find($request->id);
        $column = $request->column;
        $value = $request->value;
        $array = $request->data_array; 

        $arrayVal = $patient->$column;
        $arrayVal = explode(",", $arrayVal);
        $currentValue = isset($arrayVal[$array]) ? $arrayVal[$array] : null;
        $newvalue = $currentValue === $value ? '' : $value;
        $arrayVal[$array] = $newvalue;
        $newarrayVal = implode(",", $arrayVal);
        $patient->$column = $newarrayVal;
        $patient->save();
        
    
        return response()->json(['success' => true]);
    }
    
    public function patientDelete($id) 
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $patient = Patients::findOrFail($decryptedId);
            $patient->delete();

            return response()->json(['success' => true, 'message' => 'Deleted Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Invalid ID'], 404);
        }
    }
}
