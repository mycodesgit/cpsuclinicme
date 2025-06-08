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
            <div class="card-body">
                
                <div>
                    <table id="example" class="table table-hover patients-data">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Civil Status</th>
                                @if($id == 1)
                                <th>Remarks</th>
                                @endif
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- AJAX-loaded data will go here -->
                        </tbody>
                    </table>
                    
                    
                    {{-- <table id="example1" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Civil Status</th>
                                @if($id == 1)
                                <th>Remarks</th>
                                @endif
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $p)
                            <tr id="tr-{{ $p->id }}">
                                <td class="text-uppercase">
                                    {{ $p->lname }} {{ $p->ext }} {{ $p->fname }} {{ $p->ext_name }} {{ $p->mname }}
                                </td>                                          
                                <td>{{ $p->age }}</td>
                                <td>{{ $p->sex }}</td>
                                <td>{{ $p->c_status}}</td>
                                @if($id == 1)
                                <td>
                                    {!! ($p->pexam_remarks == 1) ? '<span class="badge badge-success">Fit for enrollment</span>' : '' !!}
                                    {!! ($p->pexam_remarks == 2) ? '<span class="badge badge-danger"> Not fit for enrollment</span>' : '' !!}
                                    {!! ($p->pexam_remarks == 3) ? '<span class="badge badge-warning" data-toggle="tooltip" title="'.$p->pend_reason.'">Pending</span>' : '' !!}
                                </td>
                                @endif
                                <td class="text-center">
                                    <a href="{{ route('moreInfo', ['id' => $p->category, 'mid' => $p->id]) }}" class="btn btn-info btn-sm text-light" title="More Info">
                                        <i class="fas fa-exclamation-circle"></i> 
                                    </a>
                                    <a href="{{ route('fileRead', ['cat' => $p->category, 'id' => $p->id]) }}" class="btn btn-success btn-sm" title="More Info">
                                        <i class="fas fa-file"></i> 
                                    </a>
                                    <a href="{{ route('reportsRead', $p->id) }}" class="btn btn-warning btn-sm" title="Pre-Entrance Health Examination Report">
                                        <i class="fas fa-file-pdf"></i> 
                                    </a>
                                    <button class="btn btn-danger btn-sm patient-delete" data-id="{{ $p->id }}" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody>
                        </tbody>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
</div>
    
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection