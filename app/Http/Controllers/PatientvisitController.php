<?php

namespace App\Http\Controllers;
use App\Models\Patients;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\Patientvisit;
use App\Models\File;
use App\Models\Complaint;
use Illuminate\Support\Facades\Log;
use DB;
 
class PatientvisitController extends Controller
{
    public function patientvisitList(Request $request){
            $date = date('Y-m-d');
            date_default_timezone_set('Asia/Manila');
            return view('patientvisit.patientvisit_list', compact('date'));   
    }

    public function patientListOption(Request $request)
    {
        $pageSize = 1000; // Records per batch
        $page = $request->input('page', 1);
    
        $patients = Patients::select('id', 'fname', 'lname', 'mname')
                            ->paginate($pageSize, ['*'], 'page', $page);
    
        return response()->json([
            'data' => $patients->items(),
            'pagination' => [
                'more' => $patients->hasMorePages()
            ]
        ]);
    }
    
    public function addPatient(Request $request){
      
            $patient = new Patientvisit();
            $patient->stid = $request->input('stid');
            $patient->date = $request->input('date');
            $patient->time = $request->input('time');
            
            $patient->save();

    return redirect()->back()->with('success', 'Added Successfully');
    }

    public function ListStudent(){   
            $patients = Patients::with('patientvisits')->get();
            return view('patientvisit.students_info', compact('patients'));
    }
    public function studentLogin(Request $request){
            $patient = new Patientvisit();
            $patient->stid = $request->input('stid');
            $patient->date = $request->input('date');
            $patient->time = $request->input('time');
            
            $patient->save();
            
            return redirect()->back()->with('success', 'Added Successfully');
    }
    public function visitSearch(Request $request, $id){
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

            $patientVisit = Patientvisit::where('stid', $id)->get();
            return view('patientvisit.patientvisit_list', compact('patients','patientSearch','patientVisit', 'meddata','quantity','files','date'));
    }
    public function patienttrans($id){
            $complaints =  Complaint::all();
            $meddatas = Medicine::all();
            $meddata = [];
            $quantity = [];
            
            foreach ($meddatas as $data) {
            $meddata[$data->id] = $data->medicine;
            $quantity[$data->id] = $data->qty;
            }
            $patients = Patients::all();
            $patientVisit = DB::table('patients')
            ->join('patientvisit', 'patients.id', '=', 'patientvisit.stid') 
            ->where('patientvisit.id', $id) 
            ->select('patients.*', 'patientvisit.*') 
            ->get();
            $medicines = Medicine::all();
            $stids = $patientVisit->pluck('stid'); 
            $files = File::where('patient_id',  $stids )->get();
            return view('patientvisit.patienttransaction', compact('patientVisit', 'medicines', 'meddata', 'files','complaints'));
  
    }   
    public function patientsAddItem(Request $request){
      
        $patient = Patientvisit::findOrFail($request->id);

        $patient->date = $request->input('date');
        $patient->time = $request->input('time');
        
        $patient->chief_complaint = $request->input('chief_complaint');
        $patient->treatment = $request->input('treatment');
        $patient->certificate = $request->input('certificate');
        
        $input1 = $request->input('qty', []);  
        $input2 = $request->input('medicine', []);
        $input3 = $request->input('chief_complaint', []);
        
        $maxCount = max(count($input1), count($input2), count($input3));
        
        $input1 = array_pad($input1, $maxCount, '');  
        $input2 = array_pad($input2, $maxCount, '');
        $input3 = array_pad($input3, $maxCount, '');
        
        $input1 = array_map(function($value) {
            return $value === null ? '' : $value;
        }, $input1);
        
        $input2 = array_map(function($value) {
            return $value === null ? '' : $value;
        }, $input2);
        
        $input3 = array_map(function($value) {
            return $value === null ? '' : $value;
        }, $input3);
        
        $complaint = implode(',', $input3);
        
        if (substr($complaint, -1) === ',') {
            $complaint = rtrim($complaint, ',');
        }
        $quantity = implode(',', $input1);
        $medicine = implode(',', $input2);
        
        $patient->medicine = $medicine;
        
        $medicinesDetails = [];
        $medicines = explode(',', $medicine);
        $quantities = explode(',', $quantity);
        
        $quantityvisit = explode(',', $patient->qty);
        
        foreach ($medicines as $index => $med) {
            $medicine2 = Medicine::select('qty', 'id', 'medicine')->where('id', $med)->first();
            
            if ($medicine2) {
                $visitQuantity = isset($quantityvisit[$index]) ? $quantityvisit[$index] : 0;
                $newQuantity = ((int)$medicine2->qty + (int)$visitQuantity) - (int)$quantities[$index];
        
                if ($newQuantity >= 0) {
                    $medicine2->update(['qty' => $newQuantity]);
        
                    $medicinesDetails[] = [
                        'id' => $medicine2->id,
                        'medicine' => $medicine2->medicine,
                        'quantity' => $newQuantity
                    ];
                }
            }
        }
        
        $patient->chief_complaint = $complaint;
        
        $patient->qty = $quantity;
        
        $patient->save();
        
            return redirect()->back()->with('success', 'Added Successfully');
    } 

    public function Settings(){
        return view ('settings.info');
    }

    public function test(Request $request){
            
        $patientvisit = Patientvisit::pluck('medicine', 'qty');
        $medicinesDetails = [];
        $patientvisit->each(function ($medicine, $qty) use (&$medicinesDetails) {
            $medicines = explode(',', $medicine);
            $quantities = explode(',', $qty);
    
            foreach ($medicines as $index => $med) {
                $medicine2 = Medicine::select('qty', 'id')->where('id', $med)->first();
    
                if ($medicine2) {
                    
                    $medicinesDetails[] = [
                        'id' => $medicine2->id,
                        'quantity' => $medicine2->qty - $quantities[$index]
                    ];
                }
            }
        });
        
        return view('test.test', compact('patientvisit', 'medicinesDetails'));
    }

    public function test2(Request $request){
        $datas=Patients::all();
        return view('test.test2', compact('datas'));
    }
    
}
        
        
