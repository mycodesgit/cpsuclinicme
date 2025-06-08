<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Models\User;

class SettingsController extends Controller
{
    public function accountRead()
    {
        return view('settings.info');
    }

    public function complaintRead(){
        $datas = Complaint::all();
        return view ('patientvisit.complaint', compact('datas'));
    }

    public function complaintCreate(Request $request){
        $request->validate([
            'complaint' => 'required',
            'colorcode' => 'nullable',
        ]);
    
        $colorcode = $request->input('colorcode') ?: '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);

        Complaint::create([
            'complaint' => $request->input('complaint'),
            'colorcode' => $colorcode,
        ]);
    
        return redirect()->back()->with('success', 'Added Successfully');
    }

    public function complaintEditRead($id){
        $complaint = Complaint::find($id);
        $datas = Complaint::all();
        return view( 'patientvisit.complaint', compact('datas','complaint'));
    }

    public function complaintUpdate(Request $request, $id)
    {
        $request->validate([
            'complaint' => 'required',
            'colorcode' => 'nullable',
        ]);
    
        $complaint = Complaint::findOrFail($id);
    
        // // Use provided colorcode or generate a random one
        // $colorcode = $request->input('colorcode') ?: '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
    
        // Update the complaint record
        $complaint->update([
            'complaint' => $request->input('complaint'),
        ]);
    
        // Redirect with success message
        return redirect()->back()->with('success', 'Updated Successfully');
    }
    

   public function complaintDelete($id){
    $complaint = Complaint::find($id);
    if ($complaint) {
        $complaint->delete();

        return response()->json([
            'status' => 200,
            'complaint' => $id,
        ]);
    }
    
    return response()->json([
        'status' => 404,
        'message' => 'Medicine not found',
    ]);
   }
  
}
