<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CPSU || Clinic</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('style/plugins/fontawesome-free-v6/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('style/dist/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dist/css/custom.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('style/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('style/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('style/plugins/fullcalendar1/fullcalendar.css') }}">
    <!-- DataTable -->
    <link rel="stylesheet" href="{{ asset('style/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('style/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        
    <!-- Logo  -->
    <link rel="shortcut icon" type="" href="{{ asset('style/dist/img/CPSU_L.png') }}">

    <style>
        .toast-top-right {
            margin-top: 45px;
        }
        .btn-primary{
            background-color: #358359 !important;
            border: #358359 !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #358359 !important;
            border-color: #358359 !important;
            color: #fff !important;
            padding: 0 10px;
            margin-top: .31rem;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff !important;
            cursor: pointer;
            display: inline-block;
            font-weight: bold;
            margin-right: 2px;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav layout-navbar-fixed text-sm">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-light bg-greenn">
            <div class="container-fluid">
                <a href="" class="">
                    <img src="{{ asset('style/dist/img/MDHULogo.png') }}" alt="AdminLTE Logo" class="brand-image">
                    <span class="brand-text font-weight-light"></span>
                </a>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse"></div>

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" role="button" style="color: #fff !important">
                            <i class="fas fa-sign-out"></i> Sign Out
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <nav class="main-header navbar navbar-expand-md navbar-light bottom-border-0" style="margin-top: 45px;">
            <div class="container-fluid">
                <a href="#" class=""></a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    @include('control.control_topmenu')
                </div>
            </div>
        </nav>

        <div class="content-wrapper" style="padding-top: 40px">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        
                    </div>
                </div>
            </div>

            <div class="content">
                @yield('body')
            </div>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                CPSU Clinic Management System
            </div>
            <strong>Maintain and Manage by <a href="#">MIS</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('style/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('style/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('style/dist/js/adminlte.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('style/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('style/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('style/plugins/toastr/toastr.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('style/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('style/plugins/moment1/moment.min.js') }}"></script>
    <script src="{{ asset('style/plugins/fullcalendar1/fullcalendar.js') }}"></script>
    <script src="{{ asset('js/event/calendar.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('style/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> 
    <script src="{{ asset('style/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('style/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('style/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('style/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('style/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/basic/table.js') }}"></script>
    <script src="{{ asset('js/validation/patientValidation.js') }}"></script>

    <script>
        // Store session message in sessionStorage
        @if(Session::has('success'))
            sessionStorage.setItem('successMessage', "{{ session('success') }}");
        @endif

        // Display the message if it's found in sessionStorage
        $(document).ready(function() {
            let message = sessionStorage.getItem('successMessage');
            if (message) {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000"
                };
                toastr.success(message);
                sessionStorage.removeItem('successMessage');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#example2').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 100] 
            });
        });

        $(function () {
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4',
                height: '100',
            })
        });
    </script>

    @if(request()->is('dashboard'))
        <script src="{{ asset('style/plugins/chart.js/Chart.min.js') }}"></script>
        <script>
            var collegeCounts = {!! json_encode($collegeCounts) !!};
            var collegeAcronyms = {!! json_encode($collegeAcronyms) !!};

            var collegeCountsmonth = {!! json_encode($collegeCountsmonth) !!};
            var collegeAcronymsmonth = {!! json_encode($collegeAcronymsmonth) !!};
        </script>
    @endif

    @if(request()->routeIs('patientAdd'))
        @include('script.addpatientScript')
    @endif

    @if(request()->routeIs('studentUpcomingRead'))
        @include('script.upcomingListScipt')
    @endif

    @if(request()->routeIs('moreInfoupcoming'))
        @include('script.updatePatientScript')
    @endif

    @if(request()->routeIs('moreInfo'))
        @include('script.patientScript')
    @endif

    @if(request()->routeIs('consultPatientRead', 'consultPatientVisitSearch', 'patientReferRead', 'referPatientVisitSearch', 'toothExtractRead', 'toothExtractSearch', 'reportsSrch', 'reportsRead'))
        @include('script.patientVisitScript')
    @endif

    @if(request()->routeIs('referPatientVisitSearch'))
        @include('script.patientVisitReferralScript')
    @endif

    @if(request()->routeIs('medicineRead'))
        @include('script.medicineScript')
    @endif

    @if(request()->is('patient/add') || request()->is('patient/moreinfo/*'))
        @include('script.patientScript')
    @endif

    @if(request()->is('dashboard'))
        @include('script.dashboardScript')
    @endif

    @if(request()->routeIs('userRead'))
        <script src="{{ asset('js/ajax/userSerialize.js') }}"></script>
    @endif
</body>
</html>
