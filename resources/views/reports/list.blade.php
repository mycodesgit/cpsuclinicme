@extends('layout.master_layout')

@section('body')
    <style>
        .mtop {
            margin-top: -15px;
        }
    </style>

    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="page-header" style="border-bottom: 1px solid #04401f;">
                            <h4>Menu</h4>
                        </div>
                        <div class="mt-3" style="font-size: 13pt;">
                            @include('control.side_menu_report')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="page-header" style="border-bottom: 1px solid #04401f;">
                        <h4>Reports </h4>
                    </div>
                    <label class="badge badge-secondary">Search Patient:</label><br>
                    <select id="mySelect" name="id" class="form-control mb-3 select2 form-control-sm student-report"
                        style="width:100%">
                        <option value="">Select Patient</option>

                    </select>
                    <br>
                    @if (isset($id))
                        {{-- <iframe src="{{ route('peheReport', $id) }}" frameborder="0" height="1000" width="100%"></iframe> --}}
                        <div class="row">
                            <div class="col-md-8">
                                <div class="patient-name">
                                    <strong
                                        style="text-transform: uppercase; color: #358359; letter-spacing: 1px; font-size: 25px;">
                                        NAME: {{ strtoupper($patientVisit->first()->lname) }}
                                        {{ strtoupper($patientVisit->first()->fname) }} {{ strtoupper($patientVisit->first()->mname) }}
                                    </strong>
                                </div>
                                <table id="example2" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Medicine Quantity</th>
                                            <th>Chief Complaint</th>
                                            <th>Treatment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patientVisit as $data)
                                            @php
                                                $medicineValues = explode(',', $data->medicine);
                                                $quantities = explode(',', $data->qty);
                                                $complaintIds = explode(',', $data->chief_complaint);
                                            @endphp
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($data->date)->format('F d, Y') }}</td>
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
                                                <td>
                                                    @foreach ($complaintIds as $compId)
                                                        @if (isset($complaints[$compId]))
                                                            @php
                                                                $bg = $complaints[$compId]->colorcode;
                                                                $hex = ltrim($bg, '#');
                                                                // Convert hex to RGB
                                                                $r = hexdec(substr($hex, 0, 2));
                                                                $g = hexdec(substr($hex, 2, 2));
                                                                $b = hexdec(substr($hex, 4, 2));
                                                                $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
                                                                $textColor = $luminance > 0.5 ? '#222' : '#fff';
                                                            @endphp
                                                            <span class="badge" style="background-color: {{ $bg }}; color: {{ $textColor }}">
                                                                {{ $complaints[$compId]->complaint }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $data->treatment }}</td>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <div id="accordion">
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne"
                                                    aria-expanded="false">
                                                    <i class="fas fa-paperclip"></i> Attachment Records
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion" style="">
                                            <div class="card-body p-1">
                                                <ul class="nav nav-pills flex-column">
                                                    @if (isset($patientVisit) && count($patientVisit) > 0)
                                                        @php $patient = $patientVisit[0]; @endphp
                                                        <li class="nav-item active">
                                                            <a href="{{ route('peheReport', $patient->stid) }}" target="_blank" class="nav-link">
                                                                <i class="fas fa-file-pdf" style="color: #fc5e5e"></i> Pre-entrance health examination
                                                            </a>
                                                        </li>
                                                    @endif

                                                    @if (isset($files))
                                                        @foreach ($files as $file)
                                                            <li class="nav-item">
                                                                <a href="{{ asset('/storage/Uploads/' . $file->file) }}" target="_blank" class="nav-link">
                                                                    <i class="fas fa-file" style="color: #358359"></i> {{ $file->file }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    @else   
                                                        <li class="nav-item">
                                                            <a href="#" class="nav-link">
                                                                <i class="fas fa-times"></i> No Attachment
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>   
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseTwo"
                                                    aria-expanded="false">
                                                    <i class="fas fa-retweet"></i> Referral Records
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordion" style="">
                                            <div class="card-body p-1">
                                                <ul class="nav nav-pills flex-column">
                                                    @if (isset($referral))
                                                        @foreach ($referral as $referralfile)
                                                        <li class="nav-item">
                                                            <a href="{{ route('referralPDF', $referralfile->id) }}" target="_blank" class="nav-link">
                                                                <i class="fas fa-file" style="color: #358359"></i> Referral Record - {{ $referralfile->date }} {{ $referralfile->time }}
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                    @else
                                                        <li class="nav-item">
                                                            <a href="#" class="nav-link">
                                                                <i class="fas fa-times"></i> No Referral Record
                                                            </a>
                                                        </li>   
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseThree"
                                                    aria-expanded="false">
                                                    <i class="fas fa-tooth"></i> Tooth Extraction Records
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-parent="#accordion" style="">
                                            <div class="card-body p-1">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
