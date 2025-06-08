@extends('layout.master_layout')

@section('body')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <table id="userlist" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Campus</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus"></i> Add
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('userCreate') }}" class="form-horizontal add-form-user" method="POST" id="addUser">
                        @csrf
                        
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12 mt-2">
                                    <span class="badge badge-secondary">Campus:</span>
                                    <select class="form-control select_camp form-control-sm" name="campus">
                                        <option disabled selected> --Select-- </option>
                                        <option value="MC">Main</option>
                                        <option value="VC">Victorias</option>
                                        <option value="SCC">San Carlos</option>
                                        <option value="HC">Hinigaran</option>
                                        <option value="MP">Moises Padilla</option>
                                        <option value="IC">Ilog</option>
                                        <option value="CA">Candoni</option>
                                        <option value="CC">Cauayan</option>
                                        <option value="SC">Sipalay</option>
                                        <option value="HinC">Hinobaan</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <span class="badge badge-secondary">Last Name:</span>
                                    <input type="text" name="lname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter Last Name" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <span class="badge badge-secondary">First Name:</span>
                                    <input type="text" name="fname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter First Name" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <span class="badge badge-secondary">Middle Name:</span>
                                    <input type="text" name="mname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter Middle Name" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <span class="badge badge-secondary">Ext:</span>
                                    <select class="form-control form-control-sm" name="ext">
                                        <option disabled selected> --- Select Here --- </option>
                                        <option value="">None</option>
                                        <option value="Jr.">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                    </select>
                               </div>
                                <div class="col-md-12 mt-2">
                                    <span class="badge badge-warning">Gender:</span>
                                    <select class="form-control form-control-sm" name="gender">
                                        <option value=""> --- Select Here --- </option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                               </div>
                               <div class="col-md-12 mt-2">
                                    <span class="badge badge-danger">Role:</span>
                                    <select class="form-control select_camp form-control-sm" name="role">
                                        <option value=""> --- Select Role --- </option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Nurse">Nurse</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <span class="badge badge-secondary">Email:</span>
                                    <input type="email" name="email" placeholder="Enter Email" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <span class="badge badge-secondary">Password:</span>
                                    <input type="password" name="password" placeholder="Enter Password" class="form-control form-control-sm">   
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button type="submit" name="btn-submit" class="btn btn-primary">
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
</div>

<div class="modal fade" id="edituserModal" tabindex="-1" role="dialog" aria-labelledby="edituserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edituserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edituserForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="edituserId">

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label><span class="badge badge-secondary">First Name:</span></label>
                                <input type="text" name="fname" id="edituserfname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter First Name" class="form-control form-control-sm">
                            </div>

                            <div class="col-md-4">
                                <label><span class="badge badge-secondary">Middle Name:</span></label>
                                <input type="text" name="mname" id="editusermname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter Middle Name" class="form-control form-control-sm">
                            </div>

                            <div class="col-md-4">
                                <label><span class="badge badge-secondary">Last Name:</span></label>
                                <input type="text" name="lname" id="edituserlname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter Last Name" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label><span class="badge badge-secondary">Ext.:</span></label>
                                <select class="form-control form-control-sm" name="ext" id="edituserext">
                                    <option value="">None</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <label><span class="badge badge-secondary">Email</span></label>
                                <input type="text" name="email" id="edituseremail" placeholder="Enter Email" class="form-control form-control-sm">
                            </div>

                            <div class="col-md-4">
                                <label><span class="badge badge-danger">Campus</span></label>
                                <select class="form-control form-control-sm" name="campus" id="editusercampus">
                                    <option disabled selected>Select</option>
                                    <option value="MC">Main</option>
                                    <option value="VC">Victorias</option>
                                    <option value="SCC">San Carlos</option>
                                    <option value="HC">Hinigaran</option>
                                    <option value="MP">Moises Padilla</option>
                                    <option value="IC">Ilog</option>
                                    <option value="CA">Candoni</option>
                                    <option value="CC">Cauayan</option>
                                    <option value="SC">Sipalay</option>
                                    <option value="HinC">Hinobaan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <div class="form-row">
                            <div class="col-md-4">
                                <label><span class="badge badge-warning">Gender</span></label>
                                <select class="form-control form-control-sm" name="gender" id="editusergender">
                                    <option value=""> --- Select Here --- </option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="col-md-8">
                                <label><span class="badge badge-success">User Level</span></label>
                                <select class="form-control form-control-sm" name="role" id="edituserrole">
                                    <option disabled selected> --Select-- </option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="Nurse">Nurse</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edituserPassModal" tabindex="-1" role="dialog" aria-labelledby="edituserPassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edituserPassModalLabel">Change User Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edituserPassForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="edituserPassId">

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label><span class="badge badge-secondary">Change New Password:</span></label>
                                <input type="text" name="password" id="edituserpass" placeholder="Enter New Password" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edituserDeactModal" tabindex="-1" role="dialog" aria-labelledby="edituserDeactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edituserDeactModalLabel">Change User Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edituserDeactForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="edituserDeactId">

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label><span class="badge badge-secondary">Name:</span></label>
                                <input type="text" id="edituserDeactfullname"  class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label><span class="badge badge-secondary">Change User Status:</span></label>
                                <select name="status" class="form-control form-control-sm" id="edituserDeactStat">
                                    <option disabled selected> --Select-- </option>
                                    <option value="1">Enable</option>
                                    <option value="2">Disabled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var useraccountRoute = "{{ route('getusersRead') }}";
    var userCreateRoute = "{{ route('userCreate') }}";
    var userUpdateRoute = "{{ route('userUpdate', ['id' => ':id']) }}";
    var userpassUpdateRoute = "{{ route('userPassUpdate', ['id' => ':id']) }}";
    var userDeactRoute = "{{ route('userStatusUpdate', ['id' => ':id']) }}";
</script>
@endsection