<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    $(document).ready(function() {
        $('#referralForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: "{{route('referralCreate') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                        $(document).trigger('referralAdded');
                        $('#addPatientReferralModal').modal('hide');
                        $('textarea[name="reasonrefer"]').val('');
                        $('textarea[name="tentdiagnose"]').val('');
                        $('textarea[name="treatmentmedgiven"]').val('');
                    } else {
                        toastr.error(response.message);
                        console.log(response);
                    }
                },
                error: function(xhr, status, error, message) {
                    var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                    toastr.error(errorMessage);
                }
            });
        });

        var studentId = window.location.pathname.split('/').pop();
        var dataTable = $('#referlisttab').DataTable({
            "ajax": {
                "url": "{{ route('getreferralRead', ['id' => ':id']) }}".replace(':id', studentId),
                "type": "GET",
            },
            destroy: true,
            info: true,
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            "columns": [
                {
                    data: 'date',
                    render: function(data, type, row) {
                        if (type === 'display' && data) {
                            var dateObj = new Date(data);
                            var options = { year: 'numeric', month: 'long', day: '2-digit' };
                            return dateObj.toLocaleDateString('en-US', options);
                        }
                        return data;
                    }
                },
                {data: 'time'},
                {data: 'preferfrom'},
                {data: 'preferto'},
                {
                    data: 'id',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var dropdown = '<div class="d-inline-block">' +
                                '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                '<div class="dropdown-menu">' +
                                '<a href="#" class="dropdown-item btn-referedit" data-id="' + row.id + '" data-preferfrom="' + row.preferfrom + '" data-preferto="' + row.preferto + '" data-reasonrefer="' + row.reasonrefer + '" data-tentdiagnose="' + row.tentdiagnose + '" data-treatmentmedgiven="' + row.treatmentmedgiven + '">' +
                                '<i class="fas fa-pen"></i> Edit' +
                                '</a>' +
                                '<button type="button" value="' + data + '" class="dropdown-item med-delete">' +
                                '<i class="fas fa-trash"></i> Delete' +
                                '</button>' +
                                '</div>' +
                                '</div>';
                            return dropdown;
                        } else {
                            return data;
                        }
                    },
                },
            ],
            "createdRow": function (row, data, index) {
                $(row).attr('id', 'tr-' + data.id); 
            }
        });
        $(document).on('referralAdded', function() {
            dataTable.ajax.reload();
        });
    });

    $(document).on('click', '.btn-referedit', function() {
        var id = $(this).data('id');
        var preferfrom = $(this).data('preferfrom');
        var preferto = $(this).data('preferto');
        var reasonrefer = $(this).data('reasonrefer');
        var tentdiagnose = $(this).data('tentdiagnose');
        var treatmentmedgiven = $(this).data('treatmentmedgiven');

        $('#editReferralId').val(id);
        $('#editReferfrom').val(preferfrom);
        $('#editReferto').val(preferto);
        $('#editreasonrefer').val(reasonrefer);
        $('#edittentdiagnose').val(tentdiagnose);
        $('#edittreatmentmedgiven').val(treatmentmedgiven);
        $('#editReferralModal').modal('show');
    });

    $('#editReferralForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: "{{ route('referralUpdate') }}",
            type: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    $('#editReferralModal').modal('hide');
                    $(document).trigger('referralAdded');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error, message) {
                var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                toastr.error(errorMessage);
            }
        });
    });

    $(document).on('click', '.med-delete', function(e) {
        var id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to recover this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('medicineDelete', '__id__') }}".replace('__id__', id),
                    success: function(response) {
                        $("#tr-" + id).delay(1000).fadeOut();
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Successfully Deleted!',
                            icon: 'warning',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if(response.success) {
                            toastr.success(response.message);
                            console.log(response);
                        }
                    }
                });
            }
        })
    });
</script>

<script>
    // Generic visit search for both consult and refer select boxes
    function visitSearch(selectId, routeNameTemplate) {
        const selectedValue = document.getElementById(selectId).value;
        if (selectedValue) {
            $('#' + selectId).prop('disabled', true);

            const url = routeNameTemplate.replace(':id', selectedValue);

            setTimeout(() => {
                window.location.href = url;
            }, 100);
        }
    }

    // Example usage in HTML:
    // <select id="mySelect" onchange="visitSearch('mySelect', '{{ route('consultPatientVisitSearch', ':id') }}')">
    // <select id="mySelectrefer" onchange="visitSearch('mySelectrefer', '{{ route('referPatientVisitSearch', ':id') }}')">
</script>

<script>
    $(document).ready(function () {
        let currentPage = 1;
        let isMoreData = true;
        let isLoading = false;

        function loadPatients() {
            if (!isMoreData || isLoading) return;

            isLoading = true;

            $.ajax({
                url: "{{ route('patientListOption') }}",
                type: 'GET',
                dataType: 'json',
                data: { page: currentPage },
                success: function (response) {
                    const $selects = $('#mySelect, #mySelectrefer');
                    const options = response.data.map(patient =>
                        `<option value="${patient.id}">${patient.fname} ${patient.lname} ${patient.mname}</option>`
                    ).join('');
                    
                    $selects.append(options);

                    isMoreData = response.pagination?.more ?? false;
                    if (isMoreData) {
                        currentPage++;
                        setTimeout(loadPatients, 200);
                    }

                    isLoading = false;
                },
                error: function () {
                    console.error('Failed to fetch patient list.');
                    isLoading = false;
                }
            });
        }

        loadPatients();
    });
</script>

