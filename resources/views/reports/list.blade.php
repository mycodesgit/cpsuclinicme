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
                                                @if (isset($patientVisit) && count($patientVisit) > 0)
                                                    @php $patient = $patientVisit[0]; @endphp
                                                    <ul class="nav nav-pills flex-column">
                                                        <li class="nav-item active">
                                                            <a href="#" class="nav-link">
                                                                <i class="fas fa-file-pdf" style="color: #358359"></i> Pre-entrance health examination
                                                            </a>
                                                        </li>
                                                    </ul>
                                                @endif

                                                @if (isset($files))
                                                    @foreach ($files as $file)
                                                        <ul class="nav nav-pills flex-column">
                                                            <li class="nav-item">
                                                                <a href="{{ asset('/storage/Uploads/' . $file->file) }}" class="nav-link">
                                                                    <i class="fas fa-file" style="color: #358359"></i> {{ $file->file }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                @else
                                                    <ul class="nav nav-pills flex-column">
                                                        <li class="nav-item">
                                                            <a href="#" class="nav-link">
                                                                <i class="fas fa-times"></i> No Attachment
                                                            </a>
                                                        </li>
                                                    </ul>
                                                @endif
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
                                                @if (isset($patientVisit) && count($patientVisit) > 0)
                                                    @php $patient = $patientVisit[0]; @endphp
                                                    <ul class="nav nav-pills flex-column">
                                                        <li class="nav-item active">
                                                            <a href="#" class="nav-link">
                                                                <i class="fas fa-file-pdf" style="color: #358359"></i> Pre-entrance health examination
                                                            </a>
                                                        </li>
                                                    </ul>
                                                @endif

                                                @if (isset($files))
                                                    @foreach ($files as $file)
                                                        <ul class="nav nav-pills flex-column">
                                                            <li class="nav-item">
                                                                <a href="{{ asset('/storage/Uploads/' . $file->file) }}" class="nav-link">
                                                                    <i class="fas fa-file" style="color: #358359"></i> {{ $file->file }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                @else
                                                    <ul class="nav nav-pills flex-column">
                                                        <li class="nav-item">
                                                            <a href="#" class="nav-link">
                                                                <i class="fas fa-times"></i> No Attachment
                                                            </a>
                                                        </li>
                                                    </ul>
                                                @endif
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
                                                @if (isset($patientVisit) && count($patientVisit) > 0)
                                                    @php $patient = $patientVisit[0]; @endphp
                                                    <ul class="nav nav-pills flex-column">
                                                        <li class="nav-item active">
                                                            <a href="#" class="nav-link">
                                                                <i class="fas fa-file-pdf" style="color: #358359"></i> Pre-entrance health examination
                                                            </a>
                                                        </li>
                                                    </ul>
                                                @endif

                                                @if (isset($files))
                                                    @foreach ($files as $file)
                                                        <ul class="nav nav-pills flex-column">
                                                            <li class="nav-item">
                                                                <a href="{{ asset('/storage/Uploads/' . $file->file) }}" class="nav-link">
                                                                    <i class="fas fa-file" style="color: #358359"></i> {{ $file->file }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                @else
                                                    <ul class="nav nav-pills flex-column">
                                                        <li class="nav-item">
                                                            <a href="#" class="nav-link">
                                                                <i class="fas fa-times"></i> No Attachment
                                                            </a>
                                                        </li>
                                                    </ul>
                                                @endif
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
