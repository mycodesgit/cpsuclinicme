@extends('layout.master_layout')

@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="page-header" style="border-bottom: 1px solid #04401f;">
                            <h4>Menu</h4>
                        </div>
                        @include('settings.settingsMenu')<br>
                        <form action="{{ isset($complaint) ? route('complaintUpdate', ['id' => $complaint->id]) : route('complaintCreate') }}" method="POST">
                            @csrf
                            <div class="form-group mt-2">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label class="badge badge-secondary">Complaint Name</label><br>
                                        <input value="{{ (isset($complaint)) ? $complaint->complaint : '' }}" type="text" name="complaint" class="form-control form-control-sm" autocomplete="off" placeholder="Complaint">
                                    </div>
                                   <br>
                                   <button id="generateBtn" type="submit" class="btn btn-success mt-3">{{ (isset($complaint)) ? 'Update' : 'Save' }}</button>
                                </div>
                            </div>
                        </form>                 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                <table id="example1" class="table table-hover">
                <thead>
                     <tr>
                         <th>Complaint</th>
                         <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                 @foreach($datas as $data)
                    <tr id="tr-{{ $data->id }}">
                        <td>{{ $data->complaint }}</td>
                        <td class="text-center">
                        <a class="btn btn-danger btn-sm complaint-delete" data-id="{{ $data->id }}" title="delete">
                            <i class="fas fa-trash"></i>
                        </a>
                             <a class="btn btn-primary btn-sm" href="{{ route('complaintEditRead', $data->id) }}" title="edit">
                                <i class="fas fa-edit"></i>
                                 </a>
                             </td>
                         </tr>
                     @endforeach
                </tbody>
            </table>
            
         </div>
    </div>
</div>
</div>
</div>
</div>  
@endsection

