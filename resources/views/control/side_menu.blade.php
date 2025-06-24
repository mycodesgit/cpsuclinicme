@php  
    $curr_route = request()->route()->getName();

    $patientAddActive = in_array($curr_route, ['patientAdd']) ? 'active' : '';
    $patientNewActive = in_array($curr_route, ['studentUpcomingRead', 'moreInfoupcoming', 'fileRead']) ? 'active' : '';
    $studentActive = in_array($curr_route, ['studentRead', 'studentShow', 'moreInfo', 'fileRead']) ? 'active' : '';
@endphp

<div class="mt-3" style="font-size: 13pt;">
    <div class="nav flex-column nav-pills nav-stacked nav-tabs-right h-100" aria-orientation="vertical">
        <a class="nav-link {{ $patientAddActive }}" href="{{ route('patientAdd') }}">Add Patient</a>
        <a class="nav-link {{ $patientNewActive }}" href="{{ route('studentUpcomingRead') }}">Students</a>
        {{-- <a class="nav-link {{ $studentActive }}" href="{{ route('studentRead') }}">Student</a> --}}


        {{-- <a class="nav-link {{ request()->is('patient/list/Student*') || request()->is('patient/moreinfo/Student*') || request()->is('file/Student*') ? 'active' : '' }}" href="{{ route('patientList', 'Student') }}"> Students</a>
        <a class="nav-link {{ request()->is('patient/list/2*') || request()->is('patient/moreinfo/2*') || request()->is('file/2*') ? 'active' : '' }}" href="{{ route('patientRead', 2) }}">Employee</a>
        <a class="nav-link {{ request()->is('patient/list/3*') || request()->is('patient/moreinfo/3*') || request()->is('file/3*')? 'active' : '' }}" href="{{ route('patientRead', 3) }}">Guest</a>                                 --}}
    </div>
</div>
