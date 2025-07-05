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

class PatientvisitReferralController extends Controller
{
    public function patientReferRead()
    {
        $date = date('Y-m-d');
        date_default_timezone_set('Asia/Manila');

        return view('patientvisit.patientvisit_listreferral', compact('date'));
    }

    public function referPatientVisitSearch(Request $request, $id)
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

        return view('patientvisit.patientvisit_listreferral', compact('patients','patientSearch','patientVisitRefer', 'meddata','quantity','files','date'));
    }

    public function referralCreate(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'preferfrom' => 'required',
                'preferto' => 'required',
                'reasonrefer' => 'required',
                'tentdiagnose' => 'required',
                'treatmentmedgiven' => 'required',
            ]);

            try {
                PatientReferral::create([
                    'stid' => $request->input('stid'),
                    'date' => $request->input('date'),
                    'time' => $request->input('time'),
                    'preferfrom' => $request->input('preferfrom'),
                    'preferto' => $request->input('preferto'),
                    'reasonrefer' => $request->input('reasonrefer'),
                    'tentdiagnose' => $request->input('tentdiagnose'),
                    'treatmentmedgiven' => $request->input('treatmentmedgiven'),
                ]);

                return response()->json(['success' => true, 'message' => 'Referral stored successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Referral'], 404);
            }
        }
    }

    public function getreferralRead(Request $request, $id) 
    {
        $decryptedId = Crypt::decryptString($id);
        $data = PatientReferral::where('stid', $decryptedId)->get();

        return response()->json(['data' => $data]);
    }

    public function referralUpdate(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'preferfrom' => 'required',
            'preferto' => 'required',
            'reasonrefer' => 'required',
            'tentdiagnose' => 'required',
            'treatmentmedgiven' => 'required',
        ]);

        try {
            $refer = PatientReferral::findOrFail($request->input('id'));
            $refer->update([
                'preferfrom' => $request->input('preferfrom'),
                'preferto' => $request->input('preferto'),
                'reasonrefer' => $request->input('reasonrefer'),
                'tentdiagnose' => $request->input('tentdiagnose'),
                'treatmentmedgiven' => $request->input('treatmentmedgiven'),
        ]);
            return response()->json(['success' => true, 'message' => 'Referral update successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to Update Referral'], 404);
        }
    }

    public function referralPDF($id)
    {   
        $barangays = DB::connection('settings')->table('barangays')->select('*');
        $cities = DB::connection('settings')->table('cities')->select('*');
        $provinces = DB::connection('settings')->table('provinces')->select('*');
        $regions = DB::connection('settings')->table('regions')->select('*');

        $pref = PatientReferral::join('patients', 'patientreferral.stid', '=', 'patients.id')
                ->leftJoinSub($barangays, 'barangays', function ($join) {
                    $join->on('patients.home_brgy', '=', 'barangays.id');
                })

                ->leftJoinSub($cities, 'cities', function ($join) {
                    $join->on('patients.home_city', '=', 'cities.city_id');
                })

                ->leftJoinSub($provinces, 'provinces', function ($join) {
                    $join->on('patients.home_province', '=', 'provinces.province_id');
                })

                ->leftJoinSub($regions, 'regions', function ($join) {
                    $join->on('patients.home_region', '=', 'regions.region_id');
                })
                ->select(
                    'patientreferral.id',
                    'patientreferral.stid',
                    'patientreferral.date',
                    'patientreferral.time',
                    'patientreferral.preferfrom',
                    'patientreferral.preferto',
                    'patientreferral.reasonrefer',
                    'patientreferral.tentdiagnose',
                    'patientreferral.treatmentmedgiven',
                    'patients.fname as patient_fname',
                    'patients.lname as patient_lname',
                    'patients.mname as patient_mname',
                    'patients.sex',
                    'patients.birthdate',
                    'patients.c_status',
                    'patients.category',
                    'barangays.name as bname',
                    'cities.name as cname',
                    'provinces.name as pname',
                    'regions.name as rname'
                )
                ->where('patientreferral.id', $id)
                ->get();

        $data = [
            'pref' => $pref,
        ];
        

        $pdf = PDF::loadView('patientvisit.patientvisit_listreferralpdf', $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }
}
