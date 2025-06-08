@extends('layout.master_layout')

@section('body')
{{-- <style>
    .mtop {
        margin-top: -13px;
    }
    .custom-input{
        height: 17px !important;
    }
</style> --}}
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
            <div class="tab-content" id="vert-tabs-right-tabContent">
                <div class="page-header d-flex justify-content-end">
                    <ul class="nav nav-pills mt-2">
                        <li class="nav-item">
                            <a class="nav-link active" href="#page1" data-toggle="tab">PERSONAL INFORMATION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#page2" data-toggle="tab">MEDICAL HISTORY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#page3" data-toggle="tab">PHYSICAL EXAMINATION</a>
                        </li>
                    </ul>
                </div>
                
                <hr>
                <div class="card-body">
                    
                    <div class="tab-content p-0" style="margin-top: -30px !important;">
                        <div class="chart tab-pane active" id="page1" style="height: 100%;">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">Last Name</label><br>
                                            <input type="text" name="lname" value="{{ ucfirst(strtolower($patients->lname)) }}" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="lname" placeholder="Enter Last Name">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">First Name</label><br>
                                            <input type="text" name="fname" value="{{ ucfirst(strtolower($patients->fname)) }}" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="fname" placeholder="Enter First Name">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">Middle Name</label><br>
                                            <input type="text" name="mname" value="{{ ucfirst(strtolower($patients->mname)) }}" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="mname" placeholder="Enter Middle Name">
                                        </div>                                                                                                                                
                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">Ext. Name</label><br>
                                            <select name="ext_name" class="form-control form-control-sm update-field">
                                                <option value=""> --Select-- </option>
                                                <option value="Jr." data-column-id="{{ $patients->id }}" data-column-name="ext_name" @if($patients->ext_name == "Jr.") selected @endif>Jr.</option>
                                                <option value="Sr." data-column-id="{{ $patients->id }}" data-column-name="ext_name" @if($patients->ext_name == "Sr.") selected @endif>Sr.</option>
                                                <option value="III" data-column-id="{{ $patients->id }}" data-column-name="ext_name" @if($patients->ext_name == "III") selected @endif>III</option>
                                                <option value="IV"  data-column-id="{{ $patients->id }}" data-column-name="ext_name" @if($patients->ext_name == "IV") selected @endif>IV</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mtop">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">Category</label><br>
                                            <select class="form-control form-control-sm update-field" name="category">
                                                <option disabled selected> --Select-- </option>
                                                <option value="Student" data-column-id="{{ $patients->id }}" data-column-name="category" @if($patients->category == "Student") selected @endif>Student</option>
                                                <option value="2" data-column-id="{{ $patients->id }}" data-column-name="category" @if($patients->category == "2") selected @endif>Employee</option>
                                                <option value="3" data-column-id="{{ $patients->id }}" data-column-name="category" @if($patients->category == "3") selected @endif>Guest</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">Date of Birth:</label>
                                            <input type="date" value="{{ $patients->birthdate }}" name="birthdate" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="birthdate" id="bday" onchange="calculateAge()">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">Age:</label>
                                            <input type="text" value="{{ $patients->age }}" name="age" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="age" id="age" readonly>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">Sex</label><br>
                                            <select name="sex" class="form-control form-control-sm update-field">
                                                <option disabled selected> --Select-- </option>
                                                <option value="Male" data-column-id="{{ $patients->id }}" data-column-name="sex" @if($patients->sex == "Male") selected @endif>Male</option>
                                                <option value="Female" data-column-id="{{ $patients->id }}" data-column-name="sex" @if($patients->sex == "Female") selected @endif>Female</option>
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
                                                    <select id="region" name="home_region" class="form-control select2 form-control-sm update-field">
                                                        <option value="">Select</option>
                                                        @foreach($regions as $region)
                                                            <option value="{{ $region->region_id }}" data-column-id="{{ $patients->id }}" data-column-name="home_region" @if($patients->home_region == $region->region_id) selected @endif>{{ $region->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
        
                                                <div class="col-md-3">
                                                    <label class="badge badge-secondary">Province:</label>
                                                    <select id="province" name="home_province" class="form-control select2 form-control-sm update-field">
                                                        <option value="">Select</option>
                                                        @foreach($hprovinces as $province)
                                                            <option value="{{ $province->province_id }}" data-column-id="{{ $patients->id }}" data-column-name="home_province" @if($patients->home_province == $province->province_id) selected @endif>{{ $province->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
        
                                                <div class="col-md-3">
                                                    <label class="badge badge-secondary">City / Municipality:</label>
                                                    <select id="city" name="home_city" class="form-control select2 form-control-sm update-field">
                                                        <option value="">Select</option>
                                                        @foreach($hcities as $city)
                                                            <option value="{{ $city->city_id }}" data-column-id="{{ $patients->id }}" data-column-name="home_city" @if($patients->home_city == $city->city_id) selected @endif>{{ $city->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label class="badge badge-secondary">Barangay:</label>
                                                    <select id="barangay" name="home_brgy" class="form-control select2 form-control-sm update-field">
                                                        <option value="">Select</option>
                                                        <option value="{{ $patients->home_brgy }}" data-column-id="{{ $patients->id }}" data-column-name="home_brgy" @if($patients->home_brgy == $hbarangays->id) selected @endif>{{ $hbarangays->name }}</option>
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
                                            <input type="number" name="contact" value="{{ $patients->contact }}" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="contact">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">Nationality:</label>
                                            <input type="text" name="stud_nation" value="{{ $patients->stud_nation }}" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="stud_nation" placeholder="Enter Nationality">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">Religion</label>
                                            <select name="stud_religion" class="form-control form-control-sm update-field">
                                                <option disabled selected> --Select-- </option>
                                                <option value="Catholic" data-column-id="{{ $patients->id }}" data-column-name="stud_religion" @if($patients->stud_religion == "Catholic") selected @endif>Catholic</option>
                                                <option value="Baptist" data-column-id="{{ $patients->id }}" data-column-name="stud_religion" @if($patients->stud_religion == "Baptist") selected @endif>Baptist</option>
                                                <option value="Iglesia" data-column-id="{{ $patients->id }}" data-column-name="stud_religion" @if($patients->stud_religion == "Iglesia") selected @endif>Iglesia ni Cristo</option>
                                                <option value="Adventist" data-column-id="{{ $patients->id }}" data-column-name="stud_religion" @if($patients->stud_religion == "Adventist") selected @endif>Adventist</option>
                                                <option value="Muslim" data-column-id="{{ $patients->id }}" data-column-name="stud_religion" @if($patients->stud_religion == "Muslim") selected @endif>Muslim</option>
                                                <option value="Protestant" data-column-id="{{ $patients->id }}" data-column-name="stud_religion" @if($patients->stud_religion == "Protestant") selected @endif>Protestant</option>
                                                <option value="Buddhist" data-column-id="{{ $patients->id }}" data-column-name="stud_religion" @if($patients->stud_religion == "Buddhist") selected @endif>Buddhist</option>
                                                <option value="Hindu" data-column-id="{{ $patients->id }}" data-column-name="stud_religion" @if($patients->stud_religion == "Hindu") selected @endif>Hindu</option>
                                                <option value="Jewish" data-column-id="{{ $patients->id }}" data-column-name="stud_religion" @if($patients->stud_religion == "Jewish") selected @endif>Jewish</option>
                                                <option value="LDS (Mormon)" data-column-id="{{ $patients->id }}" data-column-name="stud_religion" @if($patients->stud_religion == "LDS (Mormon)") selected @endif>LDS (Mormon)</option>
                                                <option value="Aglipay" data-column-id="{{ $patients->id }}" data-column-name="stud_religion" @if($patients->stud_religion == "Aglipay") selected @endif>Aglipay</option>
                                                <option value="Other" data-column-id="{{ $patients->id }}" data-column-name="stud_religion" @if($patients->stud_religion == "Other") selected @endif>Other</option>
                                            </select>
                                        </div>
                                        

                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">Civil Status</label>
                                            <select name="c_status" class="form-control form-control-sm update-field">
                                                <option disabled selected> --Select-- </option>
                                                <option value="Single" data-column-id="{{ $patients->id }}" data-column-name="c_status" @if($patients->c_status == "Single") selected @endif>Single</option>
                                                <option value="Married" data-column-id="{{ $patients->id }}" data-column-name="c_status" @if($patients->c_status == "Married") selected @endif>Married</option>
                                                <option value="Divorced" data-column-id="{{ $patients->id }}" data-column-name="c_status" @if($patients->c_status == "Divorced") selected @endif>Divorced</option>
                                                <option value="Widowed" data-column-id="{{ $patients->id }}" data-column-name="c_status" @if($patients->c_status == "Widowed") selected @endif>Widowed</option>
                                                <option value="Separated" data-column-id="{{ $patients->id }}" data-column-name="c_status" @if($patients->c_status == "Separated") selected @endif>Separated</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group mtop">
                                    <div class="form-row">

                                        <div class="col-md-4">
                                            <label class="badge badge-secondary">College/Department</label>
                                            <select name="studCollege" class="form-control form-control-sm update-field select2" data-column-id="{{ $patients->id }}" data-column-name="studCollege" id="collegeSelect">
                                                <option disabled selected> --Select-- </option>
                                                @foreach($col as $college)
                                                    <option value="{{ $college->college_abbr }}" @if($college == $patients->studCollege) selected @endif>{{ $college->college_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="badge badge-secondary">Course</label>
                                            <select name="studCourse" class="form-control form-control-sm update-field select2" data-column-id="{{ $patients->stid }}" data-column-name="studCourse" id="courseSelect">
                                                <option>{{ $patients->studCourse }}</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="badge badge-secondary">Office</label>
                                            <select class="form-control form-control-sm select2 update-field" name="office" id="office">
                                                <option disabled selected> --Select-- </option>
                                                {{-- @foreach($offices as $off)
                                                    <option value="{{ $off->id }}" data-column-id="{{ $patients->id }}" data-column-name="office" @if($off->id == $patients->office) selected @endif>{{ $off->office_abbr }}</option>
                                                @endforeach --}}
                                            </select>
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
                                                    <select id="region1" name="guardian_region" class="form-control select2 form-control-sm update-field">
                                                        <option value="">Select</option>
                                                        {{-- @foreach($regions as $region)
                                                            <option value="{{ $region->region_id }}" data-column-id="{{ $patients->id }}" data-column-name="guardian_region" @if($patients->guardian_region == $region->region_id) selected @endif>{{ $region->name }}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
        
                                                <div class="col-md-3">
                                                    <label class="badge badge-secondary">Province:</label>
                                                    <select id="province1" name="guardian_province" class="form-control select2 form-control-sm update-field">
                                                        <option value="">Select</option>
                                                        {{-- @foreach($gprovinces as $province)
                                                            <option value="{{ $province->province_id }}" data-column-id="{{ $patients->id }}" data-column-name="guardian_province" @if($patients->guardian_province == $province->province_id) selected @endif>{{ $province->name }}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label class="badge badge-secondary">City / Municipality:</label>
                                                    <select id="city1" name="guardian_city" class="form-control select2 form-control-sm update-field">
                                                        <option value="">Select</option>
                                                        {{-- @foreach($gcities as $city)
                                                            <option value="{{ $city->city_id }}" data-column-id="{{ $patients->id }}" data-column-name="guardian_city" @if($patients->guardian_city == $city->city_id) selected @endif>{{ $city->name }}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label class="badge badge-secondary">Barangay:</label>
                                                    <select id="barangay1" name="guardian_brgy" class="form-control select2 form-control-sm update-field">
                                                        <option value="">Select</option>
                                                            {{-- @if($gbarangays && $patients->guardian_brgy == $gbarangays->id)
                                                                <option value="{{ $patients->guardian_brgy }}" data-column-id="{{ $patients->id }}" data-column-name="guardian_brgy" selected>{{ $gbarangays->name }}</option>
                                                                    @else
                                                                <option value="{{ $patients->guardian_brgy }}" data-column-id="{{ $patients->id }}" data-column-name="guardian_brgy">{{ $gbarangays->name ?? 'Default Barangay' }}</option>
                                                            @endif --}}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>   

                                <div class="form-group mtop">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label class="badge badge-secondary">Name of Parents/Guardian</label>
                                            <input type="text" name="guardian" value="{{ $patients->guardian }}" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="guardian" placeholder="Enter Parents Name / Guardian">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">Occupation</label>
                                            <input type="text" name="guardian_occup" value="{{ $patients->guardian_occup }}" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="guardian_occup" placeholder="Enter Occupation">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">Contact Number:</label>
                                            <input type="number" name="guardian_contact" value="{{ $patients->guardian_contact }}" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="guardian_contact" placeholder="Enter Contact Number">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mtop">
                                    <div class="form-row">
                                        <div class="col-md-2">
                                            <label class="badge badge-secondary lbel">Height (cm)</label><br>
                                            <input type="text" name="height_cm" id="height_cm" value="{{ $patients->height_cm }}" data-column-id="{{ $patients->id }}" data-column-name="height_cm" class="form-control form-control-sm update-field" placeholder="N/A">
                                        </div>
                                    
                                        <div class="col-md-2">
                                            <label class="badge badge-secondary lbel">Height (ft)</label><br>
                                            <input type="text" name="height_ft" id="height_ft" value="{{ $patients->height_ft }}" data-column-id="{{ $patients->id }}" data-column-name="height_ft" class="form-control form-control-sm update-field" placeholder="N/A">
                                        </div>
                                    
                                        <div class="col-md-2">
                                            <label class="badge badge-secondary lbel">Weight (kg)</label><br>
                                            <input type="text" name="weight_kg" id="weight_kg" value="{{ $patients->weight_kg }}" data-column-id="{{ $patients->id }}" data-column-name="weight_kg" class="form-control form-control-sm update-field" placeholder="N/A">
                                        </div>
                                    
                                        <div class="col-md-2">
                                            <label class="badge badge-secondary lbel">Weight (lb)</label><br>
                                            <input type="text" name="weight_lb" id="weight_lb" value="{{ $patients->weight_lb }}" data-column-id="{{ $patients->id }}" data-column-name="weight_lb" class="form-control form-control-sm update-field" placeholder="N/A">
                                        </div>
                                    
                                        <div class="col-md-2">
                                            <label class="badge badge-secondary">BMI:</label>
                                            <input type="text" name="bmi" id="bmi" value="{{ $patients->bmi }}" data-column-id="{{ $patients->id }}" data-column-name="bmi" class="form-control form-control-sm" placeholder="N/A" readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="badge badge-secondary">BMI Category:</label>
                                            <input type="text" name="bami_cat" id="bmi_cat" class="form-control form-control-sm" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mtop mtop">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">Temp:</label>
                                            <input type="text" name="temp" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="temp" value="{{ $patients->temp }}" placeholder="Enter Tmp.">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">PR:</label>
                                            <input type="text" name="pr" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="pr" value="{{ $patients->pr }}" placeholder="Enter PR">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">BP:</label>
                                            <input type="text" name="bp" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="bp" value="{{ $patients->bp }}" placeholder="Enter BP">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="badge badge-secondary">RR:</label>
                                            <input type="text" name="rr" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="rr" value="{{ $patients->rr }}" placeholder="Enter RR">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="chart tab-pane" id="page2"  style="height: 100%;">

                            <div class="form-group mtop mt-2">
                                <div class="form-row">
                                    <div class="col-md-3 text-center bg-secondary">
                                        <strong>Disease</strong>
                                    </div>
                                    <div class="col-md-3 text-center bg-secondary">
                                        <strong>Specific Disease Remarks</strong>
                                    </div>
                                    <div class="col-md-2 text-center bg-secondary">
                                        <strong>Hospital Confinement</strong>
                                    </div>
                                    <div class="col-md-4 text-center bg-secondary">
                                        <strong>Date, if confined</strong>
                                    </div>
                                </div>
                                @php
                                    $labels = [
                                        "Allergy (Food, Medicine.)",
                                        "COVID-19 Infection",
                                        "Nosebleed",
                                        "Dengue Fever",
                                        "Rheumatic Fever",
                                        "Typhoid Fever",
                                        "Arthritis",
                                        "Urinary Tract Infect, STD",
                                        "Amoebiasis",
                                        "Hyperacidity",
                                        "Asthma",
                                        "Hepatitis A/B",
                                        "Heart Disease",
                                        "Mumps",
                                        "Tuberculosis, Pneumonia",
                                        "Chicken Pox",
                                        "Measles",
                                        "Fainting Spells. Seizure",
                                        "Hernia",
                                        "Thyroid Disease, Cancer",
                                    ];
                                @endphp
                                @for ($i = 0; $i < 20; $i++)
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input type="checkbox" name="disease_{{ $i }}" class="form-check-input update-field1" data-column-id="{{ $patients->id }}" data-column-name="disease" data-array="{{ $i }}" value="1" @if(isset($patients->disease[$i]) && $patients->disease[$i] == 1) checked @endif>
                                                <label class="form-check-label">{{ $labels[$i % count($labels)] }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input type="text" name="disease_rem_{{ $i }}" class="w-100 custom-input update-field1" data-column-id="{{ $patients->id }}" data-column-name="disease_rem" data-array="{{ $i }}" value="{{ isset(explode(',', $patients->disease_rem)[$i]) ? explode(',', $patients->disease_rem)[$i] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input update-field1" name="hospital_confine_{{ $i }}" id="hospital_confine_{{ $i }}" data-column-id="{{ $patients->id }}" data-column-name="hospital_confine" data-array="{{ $i }}" value="1" {{ explode(',', $patients->hospital_confine)[$i] == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label mr-3">Yes</label>&emsp;
                                                <input type="radio" class="form-check-input update-field1" name="hospital_confine_{{ $i }}" id="hospital_confine_{{ $i }}" data-column-id="{{ $patients->id }}" data-column-name="hospital_confine" data-array="{{ $i }}" value="0" {{ explode(',', $patients->hospital_confine)[$i] == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label">No</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="date" name="date_hospitaliz_{{ $i }}" class="w-100 custom-input update-field1" data-column-id="{{ $patients->id }}" data-column-name="date_hospitaliz" data-array="{{ $i }}" value="{{ isset(explode(',', $patients->date_hospitaliz)[$i]) ? explode(',', $patients->date_hospitaliz)[$i] : '' }}">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="date" name="date_hospitaliz1_{{ $i }}" class="w-100 custom-input update-field1" data-column-id="{{ $patients->id }}" data-column-name="date_hospitaliz1" data-array="{{ $i }}" value="{{ isset(explode(',', $patients->date_hospitaliz1)[$i]) ? explode(',', $patients->date_hospitaliz1)[$i] : '' }}">
                                        </div>
                                    </div>
                                @endfor
                                <hr>
                                <label class="badge badge-secondary">IMMUNIZATIONS</label><br>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="immunization1" data-column-id="{{ $patients->id }}" data-column-name="immunization1" data-array="0" value="1" @if(explode(',', $patients->immunization1)[0]  == "1") checked @endif>
                                            <label class="form-check-label">Chicken Pox</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="immunization1" data-column-id="{{ $patients->id }}" data-column-name="immunization1" data-array="1" value="1" @if(explode(',', $patients->immunization1)[1]  == "1") checked @endif>
                                            <label class="form-check-label">Hepatitis A</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="immunization1" data-column-id="{{ $patients->id }}" data-column-name="immunization1" data-array="2" value="1" @if(explode(',', $patients->immunization1)[2]  == "1") checked @endif>
                                            <label class="form-check-label">Influenza</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="immunization1" data-column-id="{{ $patients->id }}" data-column-name="immunization1" data-array="3" value="1" @if(explode(',', $patients->immunization1)[3]  == "1") checked @endif>
                                            <label class="form-check-label">Tetanus Toxoid</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="immunization1" data-column-id="{{ $patients->id }}" data-column-name="immunization1" data-array="4" value="1" @if(explode(',', $patients->immunization1)[4]  == "1") checked @endif>
                                            <label class="form-check-label">HPV Vaccine</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="immunization1" data-column-id="{{ $patients->id }}" data-column-name="immunization1" data-array="5" value="1" @if(explode(',', $patients->immunization1)[5]  == "1") checked @endif>
                                            <label class="form-check-label">Hepatitis B</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="immunization1" data-column-id="{{ $patients->id }}" data-column-name="immunization1" data-array="6" value="1" @if(explode(',', $patients->immunization1)[6]  == "1") checked @endif>
                                            <label class="form-check-label">Pneumonia</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="immunization1" data-column-id="{{ $patients->id }}" data-column-name="immunization1" data-array="7" value="1" @if(explode(',', $patients->immunization1)[7]  == "1") checked @endif>
                                            <label class="form-check-label">Rabies</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Covid Vaccine</label>
                                        <input type="text" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}"  data-array="0" data-column-name="immunization2" value="{{ isset(explode(',', $patients->immunization2)[0]) ? explode(',', $patients->immunization2)[0] : '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">1st Dose</label>
                                        <input type="date" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}"  data-array="1" data-column-name="immunization2" value="{{ isset(explode(',', $patients->immunization2)[1]) ? explode(',', $patients->immunization2)[1] : '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Covid Vaccine</label>
                                        <input type="text" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}" data-array="2" data-column-name="immunization2" value="{{ isset(explode(',', $patients->immunization2)[2]) ? explode(',', $patients->immunization2)[2] : '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">2nd Dose</label>
                                        <input type="date" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}" data-array="3" data-column-name="immunization2" value="{{ isset(explode(',', $patients->immunization2)[3]) ? explode(',', $patients->immunization2)[3] : '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Booster Dose</label>
                                        <input type="text" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}" data-array="4" data-column-name="immunization2" value="{{ isset(explode(',', $patients->immunization2)[4]) ? explode(',', $patients->immunization2)[4] : '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">1st Dose</label>
                                        <input type="date" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}" data-array="5" data-column-name="immunization2" value="{{ isset(explode(',', $patients->immunization2)[5]) ? explode(',', $patients->immunization2)[5] : '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Booster Dose</label>
                                        <input type="text" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}" data-array="6" data-column-name="immunization2" value="{{ isset(explode(',', $patients->immunization2)[6]) ? explode(',', $patients->immunization2)[6] : '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">2nd Dose</label>
                                        <input type="date" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}" data-array="7" data-column-name="immunization2" value="{{ isset(explode(',', $patients->immunization2)[7]) ? explode(',', $patients->immunization2)[7] : '' }}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Smoking</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}" data-column-name="smoking" data-array="0" placeholder="Sticks" value="{{ isset(explode(',', $patients->smoking)[0]) ? explode(',', $patients->smoking)[0] : '' }}">
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}" data-column-name="smoking" data-array="1" placeholder="Years" value="{{ isset(explode(',', $patients->smoking)[1]) ? explode(',', $patients->smoking)[1] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <label class="badge badge-secondary">Drinking</label>
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="text" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}" data-column-name="drinking" data-array="0" value="{{ isset(explode(',', $patients->drinking)[0]) ? explode(',', $patients->drinking)[0] : '' }}">
                                            </div>
                                            <div class="col-2 text-center">
                                                Beer per
                                            </div>
                                            <div class="col-2">
                                                <input type="text" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}" data-column-name="drinking" data-array="1" value="{{ isset(explode(',', $patients->drinking)[1]) ? explode(',', $patients->drinking)[1] : '' }}">
                                            </div>
                                            <div class="col-2">
                                                <input type="text" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}" data-column-name="drinking" data-array="2" value="{{ isset(explode(',', $patients->drinking)[2]) ? explode(',', $patients->drinking)[2] : '' }}">
                                            </div>
                                            <div class="col-2 text-center">
                                                Shots per
                                            </div>
                                            <div class="col-2">
                                                <input type="text" class="form-control form-control-sm update-field1" data-column-id="{{ $patients->id }}" data-column-name="drinking" data-array="3" value="{{ isset(explode(',', $patients->drinking)[3]) ? explode(',', $patients->drinking)[3] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Menarche</label>
                                        <input type="text" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="Menarche" value="{{ ucfirst(strtolower($patients->Menarche)) }}" placeholder="">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Duration</label>
                                        <input type="text" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="Duration" value="{{ ucfirst(strtolower($patients->Duration)) }}" placeholder="">
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <label class="badge badge-secondary">Interval</label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field" name="Interval" data-column-id="{{ $patients->id }}" data-column-name="Interval" value="1" @if(isset($patients->Interval) && $patients->Interval == 0) checked @endif>
                                            <label class="form-check-label mr-3">Regular</label>&emsp;
                                            <input type="radio" class="form-check-input update-field" name="Interval" data-column-id="{{ $patients->id }}" data-column-name="Interval" value="0" @if(isset($patients->Interval) && $patients->Interval == 1) checked @endif>
                                            <label class="form-check-label">Irregular</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">Pads Used per Day</label>
                                        <input type="number" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="pads_use" value="{{ $patients->pads_use }}" placeholder="">
                                    </div>

                                    <div class="col-md-9">
                                        <label class="badge badge-secondary">Menstrual Symtoms</label>
                                        <input type="text" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="mens_symp" value="{{ ucfirst(strtolower($patients->mens_symp)) }}" placeholder="">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="badge badge-secondary">LMP</label>
                                        <input type="date" class="form-control form-control-sm update-field" data-column-id="{{ $patients->id }}" data-column-name="lmp" value="{{ $patients->lmp }}" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chart tab-pane" id="page3"  style="height: 100%;">

                            <div class="form-group mtop mt-2">
                                <div class="form-row">
                                    <div class="col-md-2 text-center bg-secondary">
                                        <strong>FINDING</strong>
                                    </div>
                                    <div class="col-md-2 text-center bg-secondary">
                                        <strong>E/N</strong>
                                    </div>
                                    <div class="col-md-6 text-center bg-secondary">
                                        <strong>FINDING/S</strong>
                                    </div>
                                    <div class="col-md-2 text-center bg-secondary">
                                        <strong>OTHER FINDINGS</strong>
                                    </div>
                                </div>
                                {{-- row1 --}}
                                <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>SKIN</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="0" value="1" {{ isset(explode(',', $patients->en_pexam)[0]) && explode(',', $patients->en_pexam)[0] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="0" value="0" {{ isset(explode(',', $patients->en_pexam)[0]) && explode(',', $patients->en_pexam)[0] == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="0" value="1" {{ explode(',', $patients->findings_pexam)[0] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Discoloration</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="1" value="1" {{ explode(',', $patients->findings_pexam)[1] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Congenital Marks</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="2" value="1" {{ explode(',', $patients->findings_pexam)[2] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Lesion</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="3" value="1" {{ explode(',', $patients->findings_pexam)[3] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Deformity</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="0" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[0]) ? explode(',', $patients->other_pexam)[0] : '' }}">
                                    </div>
                                </div>
                                {{-- row2 --}}
                                <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>HEAD</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam1" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="1" value="1" {{ isset(explode(',', $patients->en_pexam)[1]) && explode(',', $patients->en_pexam)[1] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam1" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="1" value="" {{ isset(explode(',', $patients->en_pexam)[1]) && explode(',', $patients->en_pexam)[1] == '' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam1" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="4" value="1" {{ explode(',', $patients->findings_pexam)[4] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Deformity</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam1" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="5" value="1" {{ explode(',', $patients->findings_pexam)[5] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Mass/Nodules</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="1" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[1]) ? explode(',', $patients->other_pexam)[1] : '' }}">
                                    </div>
                                </div>
                                    {{-- row3 --}}
                                <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>EYES</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam2" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="2" value="1" {{ isset(explode(',', $patients->en_pexam)[2]) && explode(',', $patients->en_pexam)[2] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam2" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="2" value="" {{ isset(explode(',', $patients->en_pexam)[2]) && explode(',', $patients->en_pexam)[2] == '' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam2" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="6" value="1" {{ explode(',', $patients->findings_pexam)[6] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Deformity</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam2" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="7" value="1" {{ explode(',', $patients->findings_pexam)[7] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Discharge</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam2" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="8" value="1" {{ explode(',', $patients->findings_pexam)[8] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Swelling</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam2" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="9" value="1" {{ explode(',', $patients->findings_pexam)[9] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Pale/Red Conjectiva</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="2" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[2]) ? explode(',', $patients->other_pexam)[2] : '' }}">
                                    </div>
                                </div>
                                {{-- row4 --}}
                                <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>EARS</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam3" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="3" value="1" {{ isset(explode(',', $patients->en_pexam)[3]) && explode(',', $patients->en_pexam)[3] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam3" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="3" value="" {{ isset(explode(',', $patients->en_pexam)[3]) && explode(',', $patients->en_pexam)[3] == '' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam3" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="10" value="1" {{ explode(',', $patients->findings_pexam)[10] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Acuity (Right)</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam3" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="11" value="1" {{ explode(',', $patients->findings_pexam)[11] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Acuity (Left)</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam3" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="12" value="1" {{ explode(',', $patients->findings_pexam)[12] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Deformity</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam3" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="13" value="1" {{ explode(',', $patients->findings_pexam)[13] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Dscharges</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="3" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[3]) ? explode(',', $patients->other_pexam)[3] : '' }}">
                                    </div>
                                </div>
                                {{-- row5 --}}
                                <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>NOSE</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam4" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="4" value="1" {{ isset(explode(',', $patients->en_pexam)[4]) && explode(',', $patients->en_pexam)[4] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam4" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="4" value="" {{ isset(explode(',', $patients->en_pexam)[4]) && explode(',', $patients->en_pexam)[4] == '' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam4" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="14" value="1" {{ explode(',', $patients->findings_pexam)[14] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Deformity</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam4" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="15" value="1" {{ explode(',', $patients->findings_pexam)[15] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Lesion</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam4" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="16" value="1" {{ explode(',', $patients->findings_pexam)[16] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Bleeding</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam4" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="17" value="1" {{ explode(',', $patients->findings_pexam)[17] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Dscharge</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="4" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[4]) ? explode(',', $patients->other_pexam)[4] : '' }}">
                                    </div>
                                </div>
                                {{-- row6 --}}
                                <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>MOUTH & TONGUE</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam5" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="5" value="1" {{ isset(explode(',', $patients->en_pexam)[5]) && explode(',', $patients->en_pexam)[5] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam5" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="5" value="" {{ isset(explode(',', $patients->en_pexam)[5]) && explode(',', $patients->en_pexam)[5] == '' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam5" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="18" value="1" {{ explode(',', $patients->findings_pexam)[18] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Inflamation</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam5" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="19" value="1" {{ explode(',', $patients->findings_pexam)[19] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Lesion</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam5" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="20" value="1" {{ explode(',', $patients->findings_pexam)[20] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Tongue Deviation</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam5" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="21" value="1" {{ explode(',', $patients->findings_pexam)[21] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Deformity</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="5" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[5]) ? explode(',', $patients->other_pexam)[5] : '' }}">
                                    </div>
                                </div>
                                {{-- row7 --}}
                                <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>NECK & LYMPH NODES</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam6" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="6" value="1" {{ isset(explode(',', $patients->en_pexam)[6]) && explode(',', $patients->en_pexam)[6] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam6" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="6" value="" {{ isset(explode(',', $patients->en_pexam)[6]) && explode(',', $patients->en_pexam)[6] == '' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam6" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="22" value="1" {{ explode(',', $patients->findings_pexam)[22] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Rigidity</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam6" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="23" value="1" {{ explode(',', $patients->findings_pexam)[23] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Tenderness</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam6" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="24" value="1" {{ explode(',', $patients->findings_pexam)[24] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Mass/Swelling</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam6" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="25" value="1" {{ explode(',', $patients->findings_pexam)[25] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Fistula</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="6" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[6]) ? explode(',', $patients->other_pexam)[6] : '' }}">
                                    </div>
                                </div>
                                {{-- row8 --}}
                                <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>HEART</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam7" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="7" value="1" {{ isset(explode(',', $patients->en_pexam)[7]) && explode(',', $patients->en_pexam)[7] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam7" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="7" value="" {{ isset(explode(',', $patients->en_pexam)[7]) && explode(',', $patients->en_pexam)[7] == '' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam7" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="26" value="1" {{ explode(',', $patients->findings_pexam)[26] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Tachycardia</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam7" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="27" value="1" {{ explode(',', $patients->findings_pexam)[27] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Murmur</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam7" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="28" value="1" {{ explode(',', $patients->findings_pexam)[28] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Bradycardia</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam7" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="29" value="1" {{ explode(',', $patients->findings_pexam)[29] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Irregular Beat</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="7" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[7]) ? explode(',', $patients->other_pexam)[7] : '' }}">
                                    </div>
                                </div>
                                    {{-- row9 --}}
                                    <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>CHEST</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam8" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="8" value="1" {{ isset(explode(',', $patients->en_pexam)[8]) && explode(',', $patients->en_pexam)[8] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam8" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="8" value="" {{ isset(explode(',', $patients->en_pexam)[8]) && explode(',', $patients->en_pexam)[8] == '' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam8" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="30" value="1" {{ explode(',', $patients->findings_pexam)[30] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Tenderness</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam8" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="31" value="1" {{ explode(',', $patients->findings_pexam)[31] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Retraction</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam8" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="32" value="1" {{ explode(',', $patients->findings_pexam)[32] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Bulges</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam8" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="33" value="1" {{ explode(',', $patients->findings_pexam)[33] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Deformity</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="8" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[8]) ? explode(',', $patients->other_pexam)[8] : '' }}">
                                    </div>
                                </div>
                                {{-- row10 --}}
                                <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>LUNGS</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam9" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="9" value="1" {{ isset(explode(',', $patients->en_pexam)[9]) && explode(',', $patients->en_pexam)[9] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam9" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="9" value="" {{ isset(explode(',', $patients->en_pexam)[9]) && explode(',', $patients->en_pexam)[9] == '' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam9" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="34" value="1" {{ explode(',', $patients->findings_pexam)[34] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Wheezing</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam9" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="35" value="1" {{ explode(',', $patients->findings_pexam)[35] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Crackles</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam9" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="36" value="1" {{ explode(',', $patients->findings_pexam)[36] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Rales</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="9" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[9]) ? explode(',', $patients->other_pexam)[9] : '' }}">
                                    </div>
                                </div>
                                    {{-- row10 --}}
                                <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>BREAS & AXILLA</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam10" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="10" value="1" {{ isset(explode(',', $patients->en_pexam)[10]) && explode(',', $patients->en_pexam)[10] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam10" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="10" value="" {{ isset(explode(',', $patients->en_pexam)[10]) && explode(',', $patients->en_pexam)[10] == '' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam10" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="37" value="1" {{ explode(',', $patients->findings_pexam)[37] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Dimpling</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam10" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="38" value="1" {{ explode(',', $patients->findings_pexam)[38] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Mass/Nodu.</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam10" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="39" value="1" {{ explode(',', $patients->findings_pexam)[39] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Enlarge Lymph</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam10" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="40" value="1" {{ explode(',', $patients->findings_pexam)[40] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Discharge Nipples</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="10" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[10]) ? explode(',', $patients->other_pexam)[10] : '' }}">
                                    </div>
                                </div>
                                {{-- row11 --}}
                                <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>ABDOMEN</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam111" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="11" value="1" {{ isset(explode(',', $patients->en_pexam)[11]) && explode(',', $patients->en_pexam)[11] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam111" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="11" value="" {{ isset(explode(',', $patients->en_pexam)[11]) && explode(',', $patients->en_pexam)[11] == '' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam11" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="41" value="1" {{ explode(',', $patients->findings_pexam)[41] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Striae</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam11" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="42" value="1" {{ explode(',', $patients->findings_pexam)[42] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Mass/Nodule</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam11" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="43" value="1" {{ explode(',', $patients->findings_pexam)[43] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Tenderness</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam11" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="44" value="1" {{ explode(',', $patients->findings_pexam)[44] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Distention</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="11" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[11]) ? explode(',', $patients->other_pexam)[11] : '' }}">
                                    </div>
                                </div>
                                {{-- row12 --}}
                                <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>BACK & SHOULDERS</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam112" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="12" value="1" {{ isset(explode(',', $patients->en_pexam)[12]) && explode(',', $patients->en_pexam)[12] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam112" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="12" value="" {{ isset(explode(',', $patients->en_pexam)[12]) && explode(',', $patients->en_pexam)[12] == '' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam12" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="45" value="1" {{ explode(',', $patients->findings_pexam)[45] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Lordosis</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam12" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="46" value="1" {{ explode(',', $patients->findings_pexam)[46] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Scoliosis</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam12" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="47" value="1" {{ explode(',', $patients->findings_pexam)[47] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Kyphosis</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam12" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="48" value="1" {{ explode(',', $patients->findings_pexam)[48] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Scoliosis</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="12" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[12]) ? explode(',', $patients->other_pexam)[12] : '' }}">
                                    </div>
                                </div>
                                {{-- row13 --}}
                                <div class="form-row">
                                    <div class="col-md-2">
                                            <label class="form-check-label"><b>EXTRIMITIES</b></label>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam13" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="13" value="1" {{ isset(explode(',', $patients->en_pexam)[13]) && explode(',', $patients->en_pexam)[13] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Yes</label>&emsp;
                                            <input type="radio" class="form-check-input update-field1" name="en_pexam13" data-column-id="{{ $patients->id }}" data-column-name="en_pexam" data-array="13" value="" {{ isset(explode(',', $patients->en_pexam)[13]) && explode(',', $patients->en_pexam)[13] == '' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam13" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="49" value="1" {{ explode(',', $patients->findings_pexam)[49] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Deformity</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam13" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="50" value="1" {{ explode(',', $patients->findings_pexam)[50] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Tremors</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam13" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="51" value="1" {{ explode(',', $patients->findings_pexam)[51] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Clubbing of nails</label>&emsp;
                                            <input type="checkbox" class="form-check-input update-field1" name="findings_pexam13" data-column-id="{{ $patients->id }}" data-column-name="findings_pexam" data-array="52" value="1" {{ explode(',', $patients->findings_pexam)[52] == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Lesions</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="custom-input w-100 update-field1" data-column-id="{{ $patients->id }}"  data-array="13" data-column-name="other_pexam" value="{{ isset(explode(',', $patients->other_pexam)[13]) ? explode(',', $patients->other_pexam)[13] : '' }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label class="form-check-label"><b>OTHER SIGNIFICANT FINDINGS</b></label>
                                        <textarea type="text" class="form-control w-100 update-field" data-column-id="{{ $patients->id }}" data-column-name="other_find">{{ $patients->other_find }}</textarea>
                                    </div>
                                    <div class="col-md-12 text-left">
                                        <label class="form-check-label"><b>PWD</b></label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field" name="pexam_pwd" data-column-id="{{ $patients->id }}" data-column-name="pexam_pwd" value="1" {{ $patients->pexam_pwd == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">NO</label>&emsp;
                                            <input type="radio" class="form-check-input update-field" name="pexam_pwd" data-column-id="{{ $patients->id }}" data-column-name="pexam_pwd" value="2" {{ $patients->pexam_pwd == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">YES</label>&emsp;
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-left">
                                        <label class="form-check-label"><b>PHYSICAL EXAMINATION REMARKS</b></label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input update-field" name="pexam_remarks" data-column-id="{{ $patients->id }}" data-column-name="pexam_remarks" value="1" {{ $patients->pexam_remarks == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Fit for enrollment</label>&emsp;
                                            <input type="radio" class="form-check-input update-field" name="pexam_remarks" data-column-id="{{ $patients->id }}" data-column-name="pexam_remarks" value="2" {{ $patients->pexam_remarks == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Not fit for enrollment</label>&emsp;
                                            <input type="radio" class="form-check-input update-field" name="pexam_remarks" data-column-id="{{ $patients->id }}" data-column-name="pexam_remarks" value="3" {{ $patients->pexam_remarks == 3 ? 'checked' : '' }}>
                                            <label class="form-check-label mr-3">Pending</label>&emsp;
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-check-label"><b>PENDING REASONS</b></label>
                                        <textarea type="text" class="form-control w-100 update-field" data-column-id="{{ $patients->id }}"  data-array="13" data-column-name="pend_reason">{{ $patients->pend_reason }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="vert-tabs-right-two" role="tabpanel" aria-labelledby="vert-tabs-right-two-tab">
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection