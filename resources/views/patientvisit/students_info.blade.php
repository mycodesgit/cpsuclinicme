@extends('layout.master_layout_students')
@section('body')
<style>
    .btn-green {
      background-color: green;
      color: white;
    }
    .btn-green:hover {
      background-color:  #66cc66;
      color: white;
    }
  </style>
    <div class="col-md-4 mx-auto">
        <div class="card">
            <div class="card-body"> 
               <div class="page-header" style="border-bottom: 1px solid #04401f;">
                  <h4 style="color:green">Student Login</h4>
                      </div>
                          <div class="form-group mt-2">
                            <div class="form-row">
                                <div class="col-md-12"><br>
                            <form action="{{route('studentLogin')}}" method="post">
                         @csrf
                    <label class="badge badge-secondary">List of Student</label><br>
                <select name="stid" id="mySelect" class="form-control select2 form-control-sm update-field" style="width: 100%;">
            @foreach($patients as $patient)         
        <option value="{{ $patient->id }}">  
    {{ $patient->fname }} 
        {{ $patient->lname }}
            {{ $patient->mname }}
               </option>     
                  @endforeach
                    </select>
                        </div>
                            <div class="col-md-12"><br>
                                <label class="badge badge-secondary">Date</label>
                                    <input type="text" name="date" readonly class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                          <div class="col-md-12"><br>
                                      <label class="badge badge-secondary">Time</label>
                                  <input type="text" name="time" readonly class="form-control form-control-sm"  value="<?php date_default_timezone_set('Asia/Manila');
                               echo date('h:i A'); ?>">
                            <button class="btn btn-green float-end mt-3" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection