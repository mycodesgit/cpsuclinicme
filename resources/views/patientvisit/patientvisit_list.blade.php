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
                        <h4>Patient Visit Consulation</h4>
                    </div>

                    <div class="form-group mt-2">
                        <div class="form-row">
                            
                            <div class="col-md-10">
                                <label class="badge badge-secondary">List of Patients</label><br>
                                <div style="display:flex">
                                    <select id="mySelect" name="id"
                                        class="form-control mb-3 select2bs4 form-control-sm update-field"
                                        onchange="visitSearch('mySelect', '{{ route('consultPatientVisitSearch', ':id') }}')" style="width:100%">
                                        <option value="">Select Patient</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                @if (isset($patientSearch))
                                    <label>&nbsp;</label><br>
                                    <button type="button" class="btn btn-success btn-sm"
                                        data-toggle="modal" data-target="#addPatientModal">
                                        <i class="fa fa-plus"></i> Add New Complaint
                                    </button>
                                @endif
                            </div>
                            
                            <div class="col-md-12">
                                @if (isset($patientSearch))
                                    <div class="patient-name mt-3">
                                        <strong
                                            style="text-transform: uppercase; color: #358359; letter-spacing: 1px; font-size: 25px;">
                                            NAME: {{ strtoupper($patientSearch->fname) }}
                                            {{ substr(strtoupper($patientSearch->mname), 0,1) }}. {{ strtoupper($patientSearch->lname) }}
                                        </strong>
                                    </div>
                                    <div class="mt-3">
                                        <table id="consultationTable" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Medicine Quantity</th>
                                                    <th>Chief Complaint</th>
                                                    <th>Treatment</th>
                                                    <th width="20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($patientVisit as $data)
                                                    @php
                                                        $medicineValues = explode(',', $data->medicine);
                                                        $quantities = explode(',', $data->qty);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $data->date }}</td>
                                                        <td>{{ $data->time }}</td>
                                                        <td>
                                                            @foreach ($medicineValues as $index => $medicineId)
                                                                @if (isset($meddata[$medicineId]) && isset($quantities[$index]))
                                                                    {{ $meddata[$medicineId] }} <i class="bi bi-dash"></i>
                                                                    {{ $quantities[$index] }}
                                                                    @if (!$loop->last)
                                                                        <br>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $data->chief_complaint }}</td>
                                                        <td>{{ $data->treatment }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center mt-2">
                                                                <div class="btn-group">
                                                                    <a class="btn btn-info btn-sm btninfo1 ml-1"
                                                                        href="{{ route('consultPatientVisitTransact', $data->id) }}"
                                                                        title="edit" style="border-radius: 0.25rem;">
                                                                        <i class="fas fa-exclamation-circle text-light fa-lg"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                @endforeach --}}
                                                </tr>
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

    @if (isset($patientSearch))
        <div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog" aria-labelledby="addPatientModalLabel">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPatientModalLabel">Patient Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('addPatient') }}" class="form-horizontal" id="adPVisit">
                            @csrf
                            @if (isset($patientSearch))
                                <input value="{{ $patientSearch->id }}" type="hidden" name="stid">
                                <input type="hidden" name="date" class="form-control form-control-sm" value="{{ $date }}" readonly>
                                <input type="hidden" name="time" class="form-control form-control-sm" value="{{ date('h:i A') }}"  readonly>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label class="badge badge-secondary">Patient Name</label><br>
                                                <input type="text" readonly class="form-control form-control-sm" value="{{ $patientSearch->fname }} {{ substr($patientSearch->mname, 0,1) }}. {{ $patientSearch->lname }}">
                                            </div>
                                            <div class="col-md-12 ">
                                                <label class="badge badge-secondary mt-2">Chief
                                                    Complaint</label><br>
                                                <select name="chief_complaint[]" class="form-select select2 form-control-sm update-field" multiple>
                                                    @foreach ($complaints as $complaint)
                                                        <option style="color:black" value="{{ $complaint->id }}">
                                                            {{ $complaint->complaint }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="badge badge-secondary mt-2">Treatment</label><br>
                                                <textarea class="form-control smooth-gray-placeholder" name="treatment" rows="7"></textarea>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label class="badge badge-secondary">Certificate</label><br>
                                                <div class="d-flex">
                                                    <div class="form-check me-6 radio">
                                                        <input class="form-check-input" type="radio" name="certificate" id="withCertificate" value="1">
                                                        <label class="form-check-label" for="withCertificate">Yes</label>
                                                    </div>
                                                    <div class="form-check me-6 radio">
                                                        <input class="form-check-input ml-4" type="radio" name="certificate" id="withoutCertificate" value="0" checked>
                                                        <label class="form-check-label" for="withoutCertificate">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="badge badge-secondary">Medicine</label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="badge badge-secondary">Quantity</label>
                                            </div>
                                        </div>

                                        <div id="dynamic-fields" class="mb-3">
                                            @if ($patientVisit && count($patientVisit) > 0)
                                                @foreach ($patientVisit as $data)
                                                    @php
                                                        $medicineValues = explode(',', $data->medicine);
                                                        $quantities = explode(',', $data->qty);
                                                        $maxCount = max(count($medicineValues), count($quantities));
                                                        $medicineValues = array_pad($medicineValues, $maxCount, '');
                                                        $quantities = array_pad($quantities, $maxCount, '');
                                                    @endphp
                                                    @foreach ($medicineValues as $index => $medicineId)
                                                        <div class="row mb-3 align-items-end">
                                                            <div class="col-md-6">
                                                                <select name="medicine[]" class="form-select select2 form-control-sm update-field">
                                                                    <option value="">Select Medicine</option>
                                                                    @foreach ($medicines as $medicine)
                                                                        <option value="{{ $medicine->id }}" >
                                                                            {{ $medicine->medicine }} - ({{ $medicine->qty }} left )
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="number" placeholder="Quantity" name="qty[]" class="form-control form-control-sm" min="1">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            @else

                                            @endif
                                        </div>

                                        <div class="mt-2">
                                            <button type="button" class="btn btn-success btn-sm add-button">
                                                <i class="fa fa-plus"></i> Add
                                            </button>
                                            <button type="button" id="myremove" class="btn btn-danger btn-sm remove-button">
                                                <i class="fa fa-minus"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Place template OUTSIDE the form-group --}}
                                <template id="medicine-row-template">
                                    <div class="row mb-3 align-items-end">
                                        <div class="col-md-6">
                                            <select name="medicine[]" class="form-select select2 form-control-sm update-field">
                                                <option value="">Select Medicine</option>
                                                @foreach ($medicines as $medicine)
                                                    <option value="{{ $medicine->id }}">
                                                        {{ $medicine->medicine }} - ({{ $medicine->qty }} left )
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" placeholder="Quantity" name="qty[]" class="form-control form-control-sm" min="1">
                                        </div>
                                    </div>
                                </template>
                            </div> 
                            <hr>
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

        <div class="modal fade" id="editConsultationModal" role="dialog" aria-labelledby="editConsultationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editConsultationModalLabel">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editConsultationForm">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="editConsultationId">
                            <div class="form-group">
                                <label for="editConsultationName">Fund Name</label>
                                <input type="text" class="form-control" id="editFundName" name="fund_name">
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
    @endif

    <script>
        var pvisitCreateRoute = "{{ route('addPatient') }}";
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Select2 for existing rows
            $('.select2').select2({ width: '100%' });

            const dynamicFieldsContainer = document.getElementById('dynamic-fields');
            const template = document.getElementById('medicine-row-template');

            function toggleRemoveButton() {
                const rows = dynamicFieldsContainer.querySelectorAll('.row');
                document.getElementById('myremove').style.display = rows.length > 1 ? 'inline-block' : 'none';
            }

            // Add new row
            document.querySelector('.add-button').addEventListener('click', () => {
                if (!template) {
                    console.error("Medicine row template not found!");
                    return;
                }

                // Clone template content
                const fragment = template.content.cloneNode(true);

                // Append new row
                dynamicFieldsContainer.appendChild(fragment);

                // Initialize Select2 for only the last added select
                const newSelect = dynamicFieldsContainer.querySelectorAll('select.select2');
                $(newSelect[newSelect.length - 1]).select2({ width: '100%' });

                toggleRemoveButton();
            });

            // Remove last row
            document.getElementById('myremove').addEventListener('click', () => {
                const rows = dynamicFieldsContainer.querySelectorAll('.row');
                if (rows.length > 1) {
                    rows[rows.length - 1].remove();
                }
                toggleRemoveButton();
            });

            // Initial button toggle
            toggleRemoveButton();
        });
    </script>
@endsection
