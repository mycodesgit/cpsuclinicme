@extends('layout.master_layout')

@section('body')
<div class="container-fluid">
    <div class="row">
        <!-- Patient Card -->
        <div class="col-lg-3 col-md-6">
            <div class="small-box bg-info d-flex align-items-center justify-content-between p-3 card-curve" style="background-color: #00bc8c !important;">
                <div class="text-left">
                    <div class="inner">
                        <h3>{{ number_format($patients) }}</h3>
                        <p>Patient</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="icon">
                        <img src="{{ asset('style/dist/img/icon-1.svg') }}" width="70px" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <!-- Patient Today Card -->
        <div class="col-lg-3 col-md-6">
            <div class="small-box bg-info d-flex align-items-center justify-content-between p-3 card-curve" style="background-color:#89c9b6 !important; color: #ffffff !important;">
                <div class="text-left">
                    <div class="inner">
                        <h3>0</h3>
                        <p>Patient Today</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="icon">
                        <img src="{{ asset('style/dist/img/icon-4.svg') }}" width="70px" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <!-- Medicines Card -->
        <div class="col-lg-3 col-md-6">
            <div class="small-box bg-info d-flex align-items-center justify-content-between p-3 card-curve" style="background-color:#9dcda8 !important; color: #ffffff !important;">
                <div class="text-left">
                    <div class="inner">
                        <h3>0</h3>
                        <p>Medicines</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="icon">
                        <img src="{{ asset('style/dist/img/icon-3.png') }}" width="70px" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="col-lg-3 col-md-6">
            <div class="small-box bg-info d-flex align-items-center justify-content-between p-3 card-curve" style="background-color: #d5d5d5 !important; color: #05825f !important;">
                <div class="text-left">
                    <div class="inner">
                        <h3>{{ number_format(count($users)) }}</h3>
                        <p>Users</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="icon">
                        <img src="{{ asset('style/dist/img/icon-2.svg') }}" width="70px" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <!-- Patient Donut Chart -->
        <div class="col-md-5">
            <div class="card" style="background-color: #d5d5d5;">
                <div class="card-header">
                    <h3 class="card-title">Patient</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="donutChartPatient" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <!-- Bar Chart Patient Visit Monthly Report -->
        <div class="col-md-7 " >
            <div class="card" style="background-color: #d5d5d5;" >
                <div class="card-header" >
                    <h3 class="card-title">Patient Visit Monthly Report - {{ \Carbon\Carbon::now()->format('F d, Y') }}</h3>
                    <div class="card-tools" >
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="currcollegevisitBarChart" style="height:250px; min-height:250px"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Student Remarks Donut Chart -->
        <div class="col-lg-5 col-md-12">
            <div class="card" style="background-color: #d5d5d5;">
                <div class="card-header">
                    <h3 class="card-title">Student Remarks</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="donutChartRemarks" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-7">
            <div class="card" style="background-color: #d5d5d5;" >
                <div class="card-header" >
                    <h3 class="card-title">Patient Visit Monthly Complaints</h3>
                    <div class="card-tools" >
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" >
                    <div id="customLegend" style="position:absolute; overflow:auto; width:19%; height:240px;">
                        <p id="content"></p>
                    </div>
                    <canvas id="pieChart{{ isset($index) ? $index : 'default' }}" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
