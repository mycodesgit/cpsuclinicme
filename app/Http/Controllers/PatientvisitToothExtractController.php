<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use PDF;

use App\Models\ClinicDB\Patients;
use App\Models\ClinicDB\Medicine;

use App\Models\ClinicDB\Patientvisit;
use App\Models\ClinicDB\PatientReferral;
use App\Models\ClinicDB\File;
use App\Models\ClinicDB\Complaint;

use App\Models\SettingDB\ConfigureCurrent;
use App\Models\SettingDB\Region;
use App\Models\SettingDB\Province;
use App\Models\SettingDB\City;
use App\Models\SettingDB\Barangay;

class PatientvisitToothExtractController extends Controller
{
    public function toothExtractRead()
    {
        $date = date('Y-m-d');
        date_default_timezone_set('Asia/Manila');

        return view('patientvisit.patientvisit_listtoothextract', compact('date'));
    }

    public function toothExtractSearch(Request $request, $id)
    {
        $decryptedId = Crypt::decryptString($id);

        $date = date('Y-m-d');
        date_default_timezone_set('Asia/Manila');

        $files = File::where('patient_id', $decryptedId)->get();  
        $meddatas = Medicine::all();
        $meddata = [];
        $quantity=[];
        foreach ($meddatas as $data) {
            $meddata[$data->id] = $data->medicine;
            $quantity=[$data->id] =$data->qty;
        }

        $patients = Patients::select('id', 'fname', 'lname', 'mname')->get();
        $patientSearch = Patients::select('id', 'fname', 'lname', 'mname'   )->where('id', $decryptedId)->first();

        $patientVisitRefer = PatientReferral::where('stid', $decryptedId)->get();

        return view('patientvisit.patientvisit_listtoothextract', compact('patients','patientSearch','patientVisitRefer', 'meddata','quantity','files','date'));
    }
}
