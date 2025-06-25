<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ClinicDB\Patientvisit;
use App\Models\ClinicDB\Medicine;
use DB;

class MedicineController extends Controller
{
    public function  medicineRead()
    {
        return view('medicine.medicine_list');
    }

    public function getmedicineRead() 
    {
        $data = Medicine::orderBy('id', 'ASC')->get();

        return response()->json(['data' => $data]);
    }

    public function medicineCreate(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'medicine' => 'required',
                'qty' => 'required',
            ]);

            $medicineName = $request->input('medicine'); 
            $existingMedicine = Medicine::where('medicine', $medicineName)->first();

            if ($existingMedicine) {
                return response()->json(['error' => true, 'message' => 'Medicine already exists'], 404);
            }

            try {
                Medicine::create([
                    'medicine' => $request->input('medicine'),
                    'qty'=> $request->input('qty')
                ]);

                return response()->json(['success' => true, 'message' => 'Medicine stored successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Medicine'], 404);
            }
        }
    }

    public function medicineUpdate(Request $request) 
    {
        $request->validate([
            'medicine' => 'required',
            'qty' => 'required',
        ]);

        try {
            $medicineName = $request->input('medicine');
            $existingMedicine = Medicine::where('medicine', $medicineName)->where('id', '!=', $request->input('id'))->first();

            if ($existingMedicine) {
                return response()->json(['error' => true, 'message' => 'Medicine already exists'], 404);
            }

            $medcne = Medicine::findOrFail($request->input('id'));
            $medcne->update([
                'medicine' => $request->input('medicine'),
                'qty'=> $request->input('qty')
        ]);
            return response()->json(['success' => true, 'message' => 'Medicine update successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to Update Medicine'], 404);
        }
    }

    public function medicineDelete($id) 
    {
        $med = Medicine::find($id);
        $med->delete();

        return response()->json(['success'=> true, 'message'=>'Deleted Successfully',]);
    }
}
