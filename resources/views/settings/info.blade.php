
@extends('layout.master_layout')

@section('body')
<style>
    .mtop {
        margin-top: -15px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="page-header" style="border-bottom: 1px solid #04401f;">
                            <h4>Menu</h4>
                        </div>
                        <div class="mt-3" style="font-size: 13pt;">
                        @include('settings.settingsMenu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                <form method="post" action="" class="form-horizontal" id="addPatient">
                @csrf
                        @csrf
                        <div class="page-header" style="border-bottom: 1px solid #04401f;">
                        <h4>Account Information</h4>
                        </div>
                        <div class="form-group mt-2">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label class="badge badge-secondary">Last Name</label><br>
                                    <input type="text" name="lname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" class="form-control form-control-sm" placeholder="Enter Last Name">
                                </div>
                                <div class="col-md-4">
                                    <label class="badge badge-secondary">First Name</label><br>
                                    <input type="text" name="fname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" class="form-control form-control-sm" placeholder="Enter First Name">
                                </div>
                                <div class="col-md-4">
                                    <label class="badge badge-secondary">Middle Name</label><br>
                                    <input type="text" name="mname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" class="form-control form-control-sm" placeholder="Enter Middle Name">
                                </div>
                                <div class="col-md-4">
                                    <label class="badge badge-secondary">Ext. Name</label><br>
                                    <select class="form-control form-control-sm" name="ext_name">
                                        <option disabled selected> --Select-- </option>
                                        <option value="Jr.">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal">
                                        Reset
                                    </button>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                  </form>
                                </div>
                            </div>
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection






































