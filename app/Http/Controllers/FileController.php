<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Storage;
// use App\Http\Controllers\FileController;

use App\Models\ClinicDB\File;
use App\Models\ClinicDB\Patients;


class FileController extends Controller
{
    public function fileRead(Request $request, $id)
    {
        $patient = Patients::where('stid', $id)->first();

        $files = File::where('patient_id', $id)->get();
        
        return view('file.list', compact('files', 'patient'));
    }

    public function fileCreate(Request $request, $id)
    {     
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // without extension
            $fileName = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT) . '_' . $originalFileName . '.pdf';

            while (Storage::disk('public')->exists('Uploads/' . $fileName)) {
                $fileName = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT) . '_' . $originalFileName . '.pdf';
            }

            $path = $file->storeAs('Uploads', $fileName, 'public');

            if ($path) {
                File::create([
                    'patient_id' => $id,
                    'file' => $fileName,
                ]);

                return redirect()->back()->with('success', 'File uploaded successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to upload file.');
            }
        } else {
            return redirect()->back()->with('error', 'No file uploaded.');
        }
    }

    public function deleteFile($id){

        $file = File::find($id); 

        if ($file) {

            $file_path = public_path('Uploads/'.$file->file);
            if(file_exists( $file_path )){
                unlink($file_path);
            }
            $file->delete();
        
            return response()->json([
                'status' => 200,
                'file' => $id, 
            ]);
        }
        return response()->json([
            'status' => 404,
            'message' => 'Medicine not found',
        ]);

}}
