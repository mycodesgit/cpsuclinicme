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
                    <table id="" class="table table-hover patients-data">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Course / Year / Section</th>
                                <th>Sex</th>
                                <th>Civil Status</th>
                                @if($id == 1)
                                <th>Remarks</th>
                                @endif
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    

@endsection