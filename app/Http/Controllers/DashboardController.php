<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\ClinicDB\Patients;
use App\Models\ClinicDB\User;
use App\Models\ClinicDB\Patientvisit;
use App\Models\ClinicDB\Complaint;


class DashboardController extends Controller
{
    public function dash()
    {
        $patients = Patients::count();
        $users = User::all();

        $pstudent = Patients::where('category', '=', 'Student')->get();
        $pemployee = Patients::where('category', 2)->get();
        $pguest = Patients::where('category', 3)->get();

        $remarks1 = Patients::where('pexam_remarks', 1)->where('category', '=', 'Student')->get();
        $remarks2 = Patients::where('pexam_remarks', 2)->where('category', 1)->get();
        $remarks3 = Patients::where('pexam_remarks', 3)->where('category', 1)->get();
     
          
        $complaintsCount = Patientvisit::select('chief_complaint')
            ->whereNotNull('chief_complaint')
            ->groupBy('chief_complaint')
            ->selectRaw('count(*) as count, chief_complaint')
            ->get();
            
        $complaintsnum = $complaintsCount->pluck('chief_complaint')->toArray();

        $splitComplaints = array_map(function ($complaint) {
            return explode(',', $complaint);
            }, $complaintsnum);
        $flattenedComplaints = array_unique(array_merge(...$splitComplaints));

        $validComplaints = Complaint::whereIn('id', $flattenedComplaints)->pluck('id')->toArray();

        $filteredComplaintsCount = $complaintsCount->filter(function ($item) use ($validComplaints) {
            $splitComplaintIds = explode(',', $item->chief_complaint);
                return !empty(array_intersect($splitComplaintIds, $validComplaints));
            });

        $aggregatedComplaintCounts = [];
        foreach ($filteredComplaintsCount as $item) {
            $splitComplaintIds = explode(',', $item->chief_complaint);
            foreach ($splitComplaintIds as $complaintId) {
                if (in_array($complaintId, $validComplaints)) {
                    if (!isset($aggregatedComplaintCounts[$complaintId])) {
                        $aggregatedComplaintCounts[$complaintId] = 0;
                    }
                    $aggregatedComplaintCounts[$complaintId] += $item->count;
                }
            }
        }
        $complaintsData = Complaint::whereIn('id', $validComplaints)->get(['id', 'complaint', 'colorcode']);

        $result = array_map(function ($complaintId) use ($aggregatedComplaintCounts, $complaintsData) {
            $complaint = $complaintsData->firstWhere('id', $complaintId);

            return [
                'complaint' => $complaint->complaint ?? null,
                'count' => $aggregatedComplaintCounts[$complaintId],
                'colorcode' => $complaint->colorcode ?? null,
            ];
        }, 
        array_keys($aggregatedComplaintCounts));

        return view('home.dashboard', compact('patients', 'users', 'pstudent', 'pemployee', 'pguest', 'remarks1', 'remarks2', 'remarks3', 'result'));
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('getLogin')->with('success','You have been Successfully Logged Out');
    }
}
