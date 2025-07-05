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
                        @include('control.side_menu_pvisit')
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="page-header" style="border-bottom: 1px solid #04401f;">
                        <h4>Patient Visit Referral</h4>
                    </div>

                    <div class="form-group mt-2">
                        <div class="form-row">

                            <div class="col-md-10">
                                <label class="badge badge-secondary">List of Patients</label><br>
                                <div style="display:flex">
                                    <select id="mySelectrefer" name="id"
                                        class="form-control mb-3 select2bs4 form-control-sm update-field"
                                        onchange="visitSearch('mySelectrefer', '{{ route('referPatientVisitSearch', ':id') }}')"
                                        style="width:100%">
                                        <option value="">Select Patient</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                @if (isset($patientSearch))
                                    <label>&nbsp;</label><br>
                                    <button type="button" class="btn btn-success btn-sm add-button" data-toggle="modal"
                                        data-target="#addPatientReferralModal">
                                        <i class="fa fa-plus"></i> Add New Referral
                                    </button>
                                @endif
                            </div>

                            <div class="col-md-12">
                                @if (isset($patientSearch))
                                    <div class="patient-name mt-3">
                                        <strong
                                            style="text-transform: uppercase; color: #358359; letter-spacing: 1px; font-size: 25px;">
                                            NAME: {{ strtoupper($patientSearch->lname) }}
                                            {{ strtoupper($patientSearch->fname) }} {{ strtoupper($patientSearch->mname) }}
                                        </strong>
                                    </div>
                                    <div class="mt-3">
                                        <table id="referlisttab" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Referred from</th>
                                                    <th>Referred to</th>
                                                    <th width="20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPatientReferralModal" tabindex="-1" role="dialog"
        aria-labelledby="addPatientReferralModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPatientReferralModalLabel">Patient Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('addPatient') }}" class="form-horizontal" id="referralForm">
                        @csrf

                        @if (isset($patientSearch))
                            <input value="{{ $patientSearch->id }}" type="hidden" name="stid">
                            <input type="hidden" name="date" class="form-control form-control-sm"
                                value="{{ $date }}">
                            <input type="hidden" name="time" class="form-control form-control-sm"
                                value="{{ date('h:i A') }}">
                        @endif

                        <div class="form-group mt-2">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label class="badge badge-secondary">Reffered From</label><br>
                                    <select name="preferfrom" id="" class="form-control form-control-sm">
                                        <option disabled selected> --Select-- </option>
                                        <option value="Medical Doctor">Medical Doctor</option>
                                        <option value="School Nurse">School Nurse</option>
                                        <option value="Dentist">Dentist</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label class="badge badge-secondary">Reffered To</label><br>
                                    <select name="preferto" id="" class="form-control form-control-sm">
                                        <option disabled selected> --Select-- </option>
                                        <option value="Medical Doctor">Medical Doctor</option>
                                        <option value="CHO">CHO</option>
                                        <option value="Dentist">Dentist</option>
                                        <option value="Radiologist">Radiologist</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label class="badge badge-secondary">Reason for Referral</label><br>
                                    <textarea name="reasonrefer" id="" cols="30" rows="3" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label class="badge badge-secondary">Tentative Diagnosis</label><br>
                                    <textarea name="tentdiagnose" id="" cols="30" rows="3" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label class="badge badge-secondary">Treatment/Medication Given</label><br>
                                    <textarea name="treatmentmedgiven" id="" cols="30" rows="3"
                                        class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                                        <i class="fa fa-times"></i> Close
                                    </button>
                                    <button type="submit" class="btn btn-success btn-sm">
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

    <div class="modal fade" id="editReferralModal" tabindex="-1" role="dialog"
        aria-labelledby="editReferralModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editReferralModalLabel">Edit Referral</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editReferralForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editReferralId">
                        <div class="form-group">
                            <label for="editReferfrom">Reffered From</label>
                            <select name="preferfrom" id="editReferfrom" class="form-control form-control-sm">
                                <option disabled selected> --Select-- </option>
                                <option value="Medical Doctor">Medical Doctor</option>
                                <option value="School Nurse">School Nurse</option>
                                <option value="Dentist">Dentist</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editReferto">Reffered To</label>
                            <select name="preferto" id="editReferto" class="form-control form-control-sm">
                                <option disabled selected> --Select-- </option>
                                <option value="Medical Doctor">Medical Doctor</option>
                                <option value="CHO">CHO</option>
                                <option value="Dentist">Dentist</option>
                                <option value="Radiologist">Radiologist</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="editreasonrefer">Reason for Referral</label>
                            <textarea name="reasonrefer" id="editreasonrefer" cols="30" rows="3"
                                class="form-control form-control-sm"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edittentdiagnose">Tentative Diagnosis</label>
                            <textarea name="tentdiagnose" id="edittentdiagnose" cols="30" rows="3"
                                class="form-control form-control-sm"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edittreatmentmedgiven">Treatment/Medication Given</label>
                            <textarea name="treatmentmedgiven" id="edittreatmentmedgiven" cols="30" rows="3"
                                class="form-control form-control-sm"></textarea>
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

    <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Referral PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfIframe" src="" width="100%" height="600px" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
