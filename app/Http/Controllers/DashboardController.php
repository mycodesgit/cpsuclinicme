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
        $users = User::all();

        $pstudent = Patients::where('category', '=', 'Student')->get();
        $pemployee = Patients::where('category', 2)->get();
        $pguest = Patients::where('category', 3)->get();

        $remarks1 = Patients::where('pexam_remarks', 1)->where('category', '=', 'Student')->get();
        $remarks2 = Patients::where('pexam_remarks', 2)->where('category', '=', 'Student')->get();
        $remarks3 = Patients::where('pexam_remarks', 3)->where('category', '=', 'Student')->get();
     
        $collegeCounts = [];
        $collegeAcronyms = [];

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $programs = DB::table('college')
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
        foreach ($programs as $program) {
            $collegeAcronyms[] = $program->college_abbr;
            $collegeCounts[] = (int) $program->count; // Ensure numeric
        }

        return view('home.dashboard', compact('patients', 'users', 'pstudent', 'pemployee', 'pguest', 'remarks1', 'remarks2', 'remarks3', 'collegeCounts', 'collegeAcronyms'));
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('getLogin')->with('success','You have been Successfully Logged Out');
    }
}
