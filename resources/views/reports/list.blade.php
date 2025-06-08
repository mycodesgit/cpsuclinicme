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
                <select id="mySelect" name="id" class="form-control mb-3 select2 form-control-sm student-report" style="width:100%">
                    <option value="">Select Patient</option>
                    
                    </select>
                <br>
                @if(isset($id))
                    <iframe src="{{ route('peheReport', $id) }}" frameborder="0" height="1000" width="100%"></iframe>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection