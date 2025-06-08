@php $route = request()->route()->getName(); @endphp
<div class="mt-3" style="font-size: 13pt;">
    <div class="nav flex-column nav-pills nav-stacked nav-tabs-right h-100" aria-orientation="vertical">
    <a class="nav-link {{ $route == 'accountRead' ? 'active' : '' }}" href="{{ route('accountRead') }}">Account</a>
    <a class="nav-link {{ $route == 'complaintRead' ? 'active' : '' }}" href="{{ route('complaintRead') }}">Complaint</a>                             
    </div>
</div>