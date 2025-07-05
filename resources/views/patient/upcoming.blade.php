@extends('layout.master_layout')

@section('body')

<div class="row">
    <div class="col-md-2">
        <div class="card">
            <div class="card-body">
                <div class="">
                    <div class="page-header" style="border-bottom: 1px solid #04401f;">
                        <h4>Menu</h4>
                    </div>
                    @include('control.side_menu')
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Upcoming Students</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover upcoming-data">
                            <thead>
                                <tr>
                                    <th class="text-left">Name</th>
                                    <th class="text-left">Gender</th>
                                    <th class="text-left">Civil Status</th>
                                    <th class="text-left">Status</th>
                                    <th class="text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($enrolledstud as $datadatas)
                                    <tr>
                                    <td>{{ $datadatas->lname }}</td>
                                    <td>{{ $datadatas->stud_id }}</td>
                                    <td>{{ $datadatas->gender }}</td>
                                    <td>{{ $datadatas->progCod }}</td>
                                    <td>{{ $datadatas->id }}</td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<script>
    var patientDeleteRoute = "{{ route('patientDelete', ['id' => ':id']) }}";
</script>
@endsection