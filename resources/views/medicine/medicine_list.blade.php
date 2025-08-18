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
                        <form method="post" action="{{route('medicineCreate') }}" id="medicineForm">
                            @if(isset($medicine))
                                <input type="hidden" name="id" value="{{ $medicine->id }}">
                            @endif
                            @csrf
                            <div class="form-group mt-2">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label class="badge badge-secondary">Medicine Name</label><br>
                                        <input type="text" name="medicine" class="form-control form-control-sm" autocomplete="off" placeholder="Medicine">
                                        <label class="badge badge-secondary">Quantity</label><br>
                                        <input type="number" name="qty" class="form-control form-control-sm" autocomplete="off" placeholder="Quantity">
                                        <label class="badge badge-secondary">Expiry Date</label><br>
                                        <input type="date" name="expirydate" class="form-control form-control-sm" autocomplete="off" placeholder="Expiry Date">
                                    </div>
                                   <br>
                                   <button type="submit" class="btn btn-success mt-3">{{ (isset($medicine)) ? 'Update' : 'Save' }}</button>
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
                        <table id="medlistab" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>medicine</th>
                                    <th>Quantity</th>
                                    <th>Expiry Date</th>
                                    <th class="text-center" width="7%">Action</th>
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
</div>  

<div class="modal fade" id="editMedicineModal" tabindex="-1" role="dialog" aria-labelledby="editMedicineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMedicineModalLabel">Edit Medicine Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editMedicineForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editMedicineId">
                    <div class="form-group">
                        <label for="editMedicineName">Medicine Name</label>
                        <input type="text" class="form-control" id="editMedicineName" name="medicine">
                    </div>
                    <div class="form-group">
                        <label for="editMedicineQty">Medicine Name</label>
                        <input type="number" class="form-control" id="editMedicineQty" name="qty">
                    </div>
                    <div class="form-group">
                        <label for="editMedicineExpiry">Expiry Date</label>
                        <input type="date" class="form-control" id="editMedicineExpiry" name="expirydate">
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
@endsection

