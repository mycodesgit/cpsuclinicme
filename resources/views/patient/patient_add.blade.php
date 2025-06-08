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
                    <div class="mt-3" style="font-size: 13pt;">
                        @include('control.side_menu')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('patientCreate') }}" class="form-horizontal" id="addPatient">
                    @csrf

                    <div class="page-header" style="border-bottom: 1px solid #04401f;">
                        <h4>Personal Information</h4>
                    </div>

                    <div class="form-group mt-2">
                        <div class="form-row">
                            <div class="col-md-3">
                                <label class="badge badge-secondary">Last Name</label><br>
                                <input type="text" name="lname" class="form-control form-control-sm" placeholder="Enter Last Name">
                            </div>
                            <div class="col-md-3">
                                <label class="badge badge-secondary">First Name</label><br>
                                <input type="text" name="fname" class="form-control form-control-sm" placeholder="Enter First Name">
                            </div>
                            <div class="col-md-3">
                                <label class="badge badge-secondary">Middle Name</label><br>
                                <input type="text" name="mname" class="form-control form-control-sm" placeholder="Enter Middle Name">
                            </div>
                            <div class="col-md-3">
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

                    <div class="form-group mtop">
                        <div class="form-row">
                            <div class="col-md-3">
                                <label class="badge badge-secondary">Category</label><br>
                                <select class="form-control form-control-sm" name="category">
                                    <option disabled selected> --Select-- </option>
                                    <option value="Student">Student</option>
                                    {{-- <option value="2">Employee</option>
                                    <option value="3">Guest</option> --}}
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="badge badge-secondary">Date of Birth:</label>
                                <input type="date" name="birthdate" class="form-control form-control-sm" id="bday" onchange="calculateAge()">
                            </div>

                            <div class="col-md-3">
                                <label class="badge badge-secondary">Age:</label>
                                <input type="text" name="age" class="form-control form-control-sm" id="age" readonly>
                            </div>

                            <div class="col-md-3">
                                <label class="badge badge-secondary">Sex</label><br>
                                <select class="form-control form-control-sm" name="sex">
                                    <option disabled selected> --Select-- </option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div> 

                    <div class="form-group mtop">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-row mt-2">
                                    <div class="col-md-12">
                                        <span class="text-muted"><b>HOME ADDRESS</b></span><br>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Region:</label>
                                        <select id="region" name="home_region" class="form-control select2">
                                            <option value="">Select</option>
                                            @foreach($regions as $region)
                                                <option value="{{ $region->region_id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Province:</label>
                                        <select id="province" name="home_province" class="form-control select2" disabled>
                                            <option value="">Select</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">City / Municipality:</label>
                                        <select id="city" name="home_city" class="form-control select2" disabled>
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Barangay:</label>
                                        <select id="barangay" name="home_brgy" class="form-control select2" disabled>
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    

                    <div class="form-group mtop">
                        <div class="form-row">
                            <div class="col-md-3">
                                <label class="badge badge-secondary">Contact Number:</label>
                                <input type="number" name="contact" class="form-control form-control-sm" placeholder="Enter Contact Number">
                            </div>

                            <div class="col-md-3">
                                <label class="badge badge-secondary">Nationality:</label>
                                <input type="text" name="stud_nation" class="form-control form-control-sm" placeholder="Enter Nationality">
                            </div>

                            <div class="col-md-3">
                                <label class="badge badge-secondary">Religion</label>
                                <select class="form-control form-control-sm" name="stud_religion">
                                    <option disabled selected> --Select-- </option>
                                    <option value="Catholic">Catholic</option>
                                    <option value="Baptist">Baptist</option>
                                    <option value="Iglesia">Iglesia ni Cristo</option>
                                    <option value="Adventist">Adventist</option>
                                    <option value="Other">Other</option>
                                    <option value="Muslim">Muslim</option>
                                    <option value="Protestant">Protestant</option>
                                    <option value="Buddhist">Buddhist</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Jewish">Jewish</option>
                                    <option value="LDS (Mormon)">LDS (Mormon)</option>
                                    <option value="Aglipay">Aglipay</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="badge badge-secondary">Civil Status</label>
                                <select class="form-control form-control-sm" name="c_status">
                                    <option disabled selected> --Select-- </option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                </select>
                            </div> 
                        </div>
                    </div>

                    <div class="form-group mtop">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label class="badge badge-secondary">College/Department</label>
                                <select class="form-control form-control-sm select2" name="studCollege" id="collegeSelect">
                                    <option disabled selected> --Select-- </option>
                                    {{-- @foreach($col as $college)
                                        <option value="{{ $college }}">{{ $college }}</option>
                                    @endforeach --}}
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="badge badge-secondary">Course</label>
                                <select class="form-control form-control-sm select2" name="studCourse" id="courseSelect">
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="badge badge-secondary">Office</label>
                                <select class="form-control form-control-sm select2" name="office" id="office">
                                    <option disabled selected> --Select-- </option>
                                    {{-- @foreach($offices as $off)
                                        <option value="{{ $off->id }}">{{ $off->office_abbr }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mtop">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label class="badge badge-secondary">Full Name of Parents/Guardian</label>
                                <input type="text" name="guardian" class="form-control form-control-sm" placeholder="Enter Parents Full Name / Guardian">
                            </div>

                            <div class="col-md-3">
                                <label class="badge badge-secondary">Occupation</label>
                                <input type="text" name="guardian_occup" class="form-control form-control-sm" placeholder="Enter Occupation">
                            </div>

                            <div class="col-md-3">
                                <label class="badge badge-secondary">Contact Number:</label>
                                <input type="number" name="guardian_contact" class="form-control form-control-sm" placeholder="Enter Contact Number">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mtop">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-row mt-2">
                                    <div class="col-md-12">
                                        <span class="text-muted"><b>GUARDIAN ADDRESS</b></span><br>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Region:</label>
                                        <select id="region1" name="guardian_region" class="form-control select2">
                                            <option value="">Select</option>
                                            @foreach($regions as $region)
                                                <option value="{{ $region->region_id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Province:</label>
                                        <select id="province1" name="guardian_province" class="form-control select2" disabled>
                                            <option value="">Select</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">City / Municipality:</label>
                                        <select id="city1" name="guardian_city" class="form-control select2" disabled>
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Barangay:</label>
                                        <select id="barangay1" name="guardian_brgy" class="form-control select2" disabled>
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                        
                    
                    <div class="form-group mtop">
                        <div class="form-row">
                            <div class="col-md-2">
                                <label class="badge badge-secondary lbel">Height (cm)</label><br>
                                <input type="text" name="height_cm" id="height_cm" class="form-control form-control-sm" placeholder="N/A">
                            </div>
                        
                            <div class="col-md-2">
                                <label class="badge badge-secondary lbel">Height (ft)</label><br>
                                <input type="text" name="height_ft" id="height_ft" class="form-control form-control-sm" placeholder="N/A">
                            </div>
                        
                            <div class="col-md-2">
                                <label class="badge badge-secondary lbel">Weight (kg)</label><br>
                                <input type="text" name="weight_kg" id="weight_kg" class="form-control form-control-sm" placeholder="N/A">
                            </div>
                        
                            <div class="col-md-2">
                                <label class="badge badge-secondary lbel">Weight (lb)</label><br>
                                <input type="text" name="weight_lb" id="weight_lb" class="form-control form-control-sm" placeholder="N/A">
                            </div>
                        
                            <div class="col-md-2">
                                <label class="badge badge-secondary">BMI:</label>
                                <input type="text" name="bmi" id="bmi" class="form-control form-control-sm" placeholder="N/A" readonly>
                            </div>

                            <div class="col-md-2">
                                <label class="badge badge-secondary">BMI Category:</label>
                                <input type="text" name="bami_cat" id="bmi_cat" class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mtop">
                        <div class="form-row">
                            <div class="col-md-3">
                                <label class="badge badge-secondary">Temp:</label>
                                <input type="text" name="temp" class="form-control form-control-sm" placeholder="Enter Tmp.">
                            </div>

                            <div class="col-md-3">
                                <label class="badge badge-secondary">PR:</label>
                                <input type="text" name="pr" class="form-control form-control-sm" placeholder="Enter PR">
                            </div>
                            <div class="col-md-3">
                                <label class="badge badge-secondary">BP:</label>
                                <input type="text" name="bp" class="form-control form-control-sm" placeholder="Enter BP">
                            </div>
                            <div class="col-md-3">
                                <label class="badge badge-secondary">RR:</label>
                                <input type="text" name="rr" class="form-control form-control-sm" placeholder="Enter RR">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <button type="reset" class="btn btn-danger btn-sm" data-dismiss="modal">
                                    Reset
                                </button>
                                <button type="submit" class="btn btn-success btn-sm btn-save">
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
