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
                        @include('control.side_menu_pvisit')
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="page-header" style="border-bottom: 1px solid #04401f;">
                        <h4>Patient Visit Consulation</h4>
                    </div>

                    <div class="form-group mt-2">
                        <div class="form-row">
                            
                            <div class="col-md-10">
                                <label class="badge badge-secondary">List of Patients</label><br>
                                <div style="display:flex">
                                    <select id="mySelect" name="id"
                                        class="form-control mb-3 select2bs4 form-control-sm update-field"
                                        onchange="visitSearch('mySelect', '{{ route('consultPatientVisitSearch', ':id') }}')" style="width:100%">
                                        <option value="">Select Patient</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                @if (isset($patientSearch))
                                    <label>&nbsp;</label><br>
                                    <button type="button" class="btn btn-success btn-sm add-button"
                                        data-toggle="modal" data-target="#addPatientModal">
                                        <i class="fa fa-plus"></i> Add New Complaint
                                    </button>
                                @endif
                            </div>
                            
                            <div class="col-md-12">
                                @if (isset($patientSearch))
                                    <div class="patient-name mt-3">
                                        <strong
                                            style="text-transform: uppercase; color: #358359; letter-spacing: 1px; font-size: 25px;">
                                            NAME: {{ strtoupper($patientSearch->fname) }}
                                            {{ substr(strtoupper($patientSearch->mname), 0,1) }}. {{ strtoupper($patientSearch->lname) }}
                                        </strong>
                                    </div>
                                    <div class="mt-3">
                                        <table id="example2" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Medicine Quantity</th>
                                                    <th>Chief Complaint</th>
                                                    <th>Treatment</th>
                                                    <th width="20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($patientVisit as $data)
                                                    @php
                                                        $medicineValues = explode(',', $data->medicine);
                                                        $quantities = explode(',', $data->qty);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $data->date }}</td>
                                                        <td>{{ $data->time }}</td>
                                                        <td>
                                                            @foreach ($medicineValues as $index => $medicineId)
                                                                @if (isset($meddata[$medicineId]) && isset($quantities[$index]))
                                                                    {{ $meddata[$medicineId] }} <i class="bi bi-dash"></i>
                                                                    {{ $quantities[$index] }}
                                                                    @if (!$loop->last)
                                                                        <br>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $data->chief_complaint }}</td>
                                                        <td>{{ $data->treatment }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center mt-2">
                                                                <div class="btn-group">

                                                                    <button type="button"
                                                                        class="fas fa-file-pdf text-danger fa-1x pdfbtn1"
                                                                        style="border:1px red solid; border-top-left-radius:5px;border-bottom-left-radius:5px;">
                                                                        <i class=""></i>
                                                                    </button>

                                                                    <button type="button"
                                                                        class="btn btn-danger btn-sm dropdown-toggle dropdown-icon pdfbtn2"
                                                                        data-toggle="dropdown" aria-expanded="false">
                                                                        <span class="sr-only">Toggle Dropdown</span>
                                                                    </button>

                                                                    <div class="dropdown-menu ml-n5" role="menu">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another
                                                                            action</a>
                                                                        <a class="dropdown-item" href="#">Something
                                                                            else here</a>
                                                                        <a class="dropdown-item" href="#">Separated
                                                                            link</a>
                                                                    </div>

                                                                    <a class="btn btn-info btn-sm btninfo1 ml-1"
                                                                        href="{{ route('consultPatientVisitTransact', $data->id) }}"
                                                                        title="edit" style="border-radius: 0.25rem;">
                                                                        <i
                                                                            class="fas fa-exclamation-circle text-light fa-lg"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog" aria-labelledby="addPatientModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPatientModalLabel">Patient Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('addPatient') }}" class="form-horizontal">
                        @csrf
                        <div class="form-group mt-2">
                            <div class="form-row">
                                @if (isset($patientSearch))
                                    <input value="{{ $patientSearch->id }}" type="hidden" name="stid">
                                @endif
                                <div class="col-md-6">
                                    <label class="badge badge-secondary">Date</label><br>
                                    <input type="date" name="date" class="form-control form-control-sm"
                                        value="{{ $date }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="badge badge-secondary">Time</label><br>
                                    <input type="text" name="time" class="form-control form-control-sm"
                                        value="{{ date('h:i A') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                                        <i class="fa fa-times"></i> Close
                                    </button>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
