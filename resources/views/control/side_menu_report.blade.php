@php $route = request()->route()->getName(); @endphp
<div class="mt-3" style="font-size: 13pt;">
    <div class="nav flex-column nav-pills nav-stacked nav-tabs-right h-100" aria-orientation="vertical">
        <a class="nav-link {{ request()->is('reports') || request()->is('reports/*') ? 'active' : '' }}" href="">Patients</a>
        <a class="nav-link {{ request()->is('medicines/*') ? 'active' : '' }}" href="">Medicines</a>                                
    </div>
</div>