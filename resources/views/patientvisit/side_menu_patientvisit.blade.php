<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
@php
$route = request()->route()->getName();
@endphp  
        <h4 class="file-name ml-2 mb-0 atta" style="text-indent: -7px">Attachment</h4>
        <div class="page-header hrs" style="border-bottom: 1px solid #04401f; width:100%; position: relative; bottom:-8px">
        </div>
        <div class="">
        <div class="mt-3" style="font-size: 13pt;">
        <div class=" d-flex align-items-center mt-2">
        <div class="file-thumbnail text-center">
            </div>
                 </div>    
                    <div class="nav flex-column nav-pills nav-stacked nav-tabs-right h-100" aria-orientation="vertical">
                        <div class="table-responsive p-0" id="myDiv">
                             @if(isset($patientVisit) && count($patientVisit) > 0)
                                @php $patient = $patientVisit[0]; @endphp <!--Handumanan ni Wilfre-->
                                <a href="{{ route('reportsRead', $patient->stid) }}" target="_blank" style="text-decoration:none">
                                 <div class="d-flex align-items-center mt-2">
                                <div class="file-thumbnail text-center">
                                <i class="fas fa-file-pdf text-danger ml-2 fa-1x"></i>
                                </div>
                                <p class="file-name ml-2 mb-0">Pre-entrance health examination</p>
                                </div>
                                </a>
                                @endif
                            @if(isset($files))
                            @foreach($files as $file)
                                <a href="{{ asset('Uploads/'. $file->file) }}" target="_blank" style="text-decoration:none">
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="file-thumbnail text-center">
                                            <i class="fas fa-file-pdf text-danger ml-2 fa-1x"></i>
                                        </div>
                                        <p class="file-name ml-2 mb-0">{{ $file->file }}</p>
                                    </div>
                                </a>
                        @endforeach
                        @else
                    @endif 
                </div>  
            </div>
        </div>
    </div>

