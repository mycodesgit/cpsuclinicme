@php 
    $curr_route = request()->route()->getName();

    $consultPatientActive = in_array($curr_route, ['consultPatientRead', 'consultPatientVisitSearch', 'consultPatientVisitTransact']) ? 'active' : '';
    $referPatientActive = in_array($curr_route, ['patientReferRead', 'referPatientVisitSearch']) ? 'active' : '';
@endphp

<div class="mt-3" style="font-size: 13pt;">
    <div class="nav flex-column nav-pills nav-stacked nav-tabs-right h-100" aria-orientation="vertical">
        <a href="{{ route('consultPatientRead') }}" class="nav-link {{ $consultPatientActive }}">Consultation</a>
        <a href="{{ route('patientReferRead') }}" class="nav-link {{ $referPatientActive }}">Referral</a>                                
        <a class="nav-link" href="">Tooth Extraction</a>                                
    </div>
</div>