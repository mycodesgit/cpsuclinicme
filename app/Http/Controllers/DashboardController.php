<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\ClinicDB\Patients;
use App\Models\ClinicDB\User;
use App\Models\ClinicDB\Patientvisit;
use App\Models\ClinicDB\Complaint;
use App\Models\ClinicDB\College;


class DashboardController extends Controller
{
    public function dash()
    {
        $patients = Patients::count();
        $ptodayvisits = Patientvisit::whereDate('created_at', Carbon::today())->count();
        $pthismonthvisits = Patientvisit::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $users = User::all();

        $pstudent = Patients::where('category', '=', 'Student')->get();
        $pemployee = Patients::where('category', 2)->get();
        $pguest = Patients::where('category', 3)->get();

        $remarks1 = Patients::where('pexam_remarks', 1)->where('category', '=', 'Student')->get();
        $remarks2 = Patients::where('pexam_remarks', 2)->where('category', '=', 'Student')->get();
        $remarks3 = Patients::where('pexam_remarks', 3)->where('category', '=', 'Student')->get();
        $remarks4 = Patients::whereNull('pexam_remarks')->where('category', '=', 'Student')->get();
     
        $collegeCounts = [];
        $collegeAcronyms = [];

        $collegeCountsmonth = [];
        $collegeAcronymsmonth = [];

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $programs = DB::table('college')
            ->leftJoin('patients', 'college.college_abbr', '=', 'patients.studCollege')
            ->leftJoin('patientvisits', function ($join) {
            $join->on('patients.id', '=', 'patientvisits.stid')
                ->whereDate('patientvisits.created_at', '=', Carbon::today());
            })
            ->select(
            'college.college_abbr',
            DB::raw('COUNT(patientvisits.id) as count')
            )
            ->groupBy('college.college_abbr')
            ->orderBy('college.college_abbr')
            ->get();

        // Populate arrays for chart
        foreach ($programs as $program) {
            $collegeAcronyms[] = $program->college_abbr;
            $collegeCounts[] = (int) $program->count; // Ensure numeric
        }

        $programsmonth = DB::table('college')
            ->leftJoin('patients', 'college.college_abbr', '=', 'patients.studCollege')
            ->leftJoin('patientvisits', function ($join) use ($currentMonth, $currentYear) {
                $join->on('patients.id', '=', 'patientvisits.stid')
                    ->whereMonth('patientvisits.created_at', '=', $currentMonth)
                    ->whereYear('patientvisits.created_at', '=', $currentYear);
            })
            ->select(
                'college.college_abbr',
                DB::raw('COUNT(patientvisits.id) as count')
            )
            ->groupBy('college.college_abbr')
            ->orderBy('college.college_abbr')
            ->get();

        // Populate arrays for chart
        foreach ($programsmonth as $program) {
            $collegeAcronymsmonth[] = $program->college_abbr;
            $collegeCountsmonth[] = (int) $program->count; // Ensure numeric
        }

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
        }, array_keys($aggregatedComplaintCounts));

        return view('home.dashboard', compact('patients', 'ptodayvisits', 'pthismonthvisits', 'users', 'pstudent', 'pemployee', 'pguest', 'remarks1', 'remarks2', 'remarks3', 'remarks4', 'collegeCounts', 'collegeAcronyms', 'collegeCountsmonth', 'collegeAcronymsmonth', 'result'));
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('getLogin')->with('success','You have been Successfully Logged Out');
    }
}
