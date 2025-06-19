<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ClinicDB\Patientvisit;
use App\Models\ClinicDB\Medicine;
use DB;

class MedicineController extends Controller
{
    public function  medicineRead(){
  
      

        $datas = Medicine::all();
        return view('medicine.medicine_list', ['datas'=>$datas]);
    }
    public function medicineInsert(Request $request){

        $request->validate([
         'medicine' => 'required',
         'qty' => 'required'

        ]);
        
        Medicine::create([
          'medicine' => $request->input('medicine'),
          'qty'=> $request->input('qty')

        ]);
      
        return redirect()->back()->with('success', 'Added Successfully');
    }
    public function medicineDelete($id){
        $medicine = Medicine::find($id);
        if ($medicine) {
            $medicine->delete();
    
            return response()->json([
                'status' => 200,
                'mid' => $id,
            ]);
        }
        
        return response()->json([
            'status' => 404,
            'message' => 'Medicine not found',
        ]);
    }
    public function medicineEditRead($id){
        $medicine = Medicine::find($id);
        $datas = Medicine::all();
       
     return view('medicine.medicine_list', compact('medicine','datas'));
    }
    public function medicineUpdate(Request $request){

        $request->validate([
            'medicine' => 'required',
            'qty' => 'required'
        ]);

        $medicine = Medicine::findOrFail($request->id);       
        if ($request->has('medicine')) {
            $medicine->medicine = $request->input('medicine');
        }
        if ($request->has('qty')) {
            $medicine->qty = $request->input('qty');
        }
          $medicine->save();
        return redirect()->back()->with('success', 'Updated Successfully');
    }
}
