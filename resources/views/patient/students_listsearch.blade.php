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
                <h4 class="card-title">Students</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12" style="border-bottom: 1px solid #dfdfdf;">
                        <form method="GET" action="{{ route('studentShow') }}">
                            <div class="form-group" style="">
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label><span class="badge badge-secondary">Campus</span></label>
                                        <select class="form-control form-control-sm" name="campus" id="campus">
                                            <option value="MC">Main</option>
                                            @if(Auth::guard('web')->user()->role == 'Administrator')
                                                <option value="VC">Victorias</option>
                                                <option value="SCC">San Carlos</option>
                                                <option value="HC">Hinigaran</option>
                                                <option value="MP">Moises Padilla</option>
                                                <option value="IC">Ilog</option>
                                                <option value="CA">Candoni</option>
                                                <option value="CC">Cauayan</option>
                                                <option value="SC">Sipalay</option>
                                                <option value="HinC">Hinobaan</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label><span class="badge badge-secondary">School Year</span></label>
                                        <select class="form-control form-control-sm" name="schlyear">
                                            <option disabled {{ request('schlyear') ? '' : 'selected' }}>---Select---</option>
                                            @foreach($sy as $datasy)
                                                <option value="{{ $datasy->schlyear }}" {{ request('schlyear') == $datasy->schlyear ? 'selected' : '' }}>
                                                    {{ $datasy->schlyear }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label><span class="badge badge-secondary">Semester</span></label>
                                        <select class="form-control form-control-sm" name="semester">
                                            <option disabled {{ request('semester') ? '' : 'selected' }}>---Select---</option>
                                            <option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>First Semester</option>
                                            <option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>Second Semester</option>
                                            <option value="3" {{ request('semester') == '3' ? 'selected' : '' }}>Summer</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="form-control form-control-sm btn btn-success btn-sm" style="background-color: #358359 !important; border-color: #358359 !important">OK</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-12 mt-3">
                        <table class="table table-hover patient-data">
                            <thead>
                                <tr>
                                    <th class="text-left">Name</th>
                                    <th class="text-left">StudIDno</th>
                                    <th class="text-left">Gender</th>
                                    <th class="text-left">Degree</th>
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
    

@endsection