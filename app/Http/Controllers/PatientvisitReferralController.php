<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use PDF;

use App\Models\ClinicDB\Patients;
use App\Models\ClinicDB\Medicine;

use App\Models\ClinicDB\Patientvisit;
use App\Models\ClinicDB\PatientReferral;
use App\Models\ClinicDB\File;
use App\Models\ClinicDB\Complaint;

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
        $date = date('Y-m-d');
        date_default_timezone_set('Asia/Manila');

        $files = File::where('patient_id', $id)->get();  
        $meddatas = Medicine::all();
        $meddata = [];
        $quantity=[];
        foreach ($meddatas as $data) {
            $meddata[$data->id] = $data->medicine;
            $quantity=[$data->id] =$data->qty;
        }

        $patients = Patients::select('id', 'fname', 'lname', 'mname')->get();
        $patientSearch = Patients::select('id', 'fname', 'lname', 'mname'   )->where('id', $id)->first();

        $patientVisitRefer = PatientReferral::where('stid', $id)->get();

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
        $data = PatientReferral::where('stid', $id)->get();

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

    public function referralPDF()
    {               
        $pdf = PDF::loadView('patientvisit.patientvisit_listreferralpdf')->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }
}
