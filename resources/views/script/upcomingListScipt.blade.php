<script>
$(document).ready(function() {
    // var urlParams = new URLSearchParams(window.location.search);
    // var campus = urlParams.get('campus') || ''; 
    // var schlyear = urlParams.get('schlyear') || ''; 
    // var semester = urlParams.get('semester') || ''; 

    $('.upcoming-data').DataTable({
        "ajax": {
            "url": "{{ route('getStudentUpcomingData') }}",
            // "data": function(d) {
            //     d.campus = campus; // Add the campus parameter to the request
            //     d.schlyear = schlyear; // Add the campus parameter to the request
            //     d.semester = semester; // Add the campus parameter to the request
            // }
        },
        responsive: true,
        lengthChange: true,
        searching: true,
        paging: true,
        "columns": [
            // { data: 'id'},
            { 
                data: null,
                render: function(data, type, row) {
                    // Format: Lastname, Firstname M.
                    let lname = row.lname || '';
                    let fname = row.fname || '';
                    let mname = row.mname ? row.mname.charAt(0) + '.' : '';
                    return `${lname}, ${fname} ${mname}`.trim();
                }
            }, 
            { data: 'sex' },   
            { data: 'c_status' },   
            { 
                data: 'pexam_remarks', 
                render: function(data, type, row) {
                    if (data == 1) {
                        return '<span class="badge badge-success">Fit for enrollment</span>';
                    } else if (data == 2) {
                        return '<span class="badge badge-danger">Not fit for enrollment</span>';
                    } else if (data == 3) {
                        return `<span class="badge badge-warning" data-toggle="tooltip" title="${row.pend_reason}">Pending</span>`;
                    } else {
                        return '<span class="badge badge-info">NO Remarks</span>';
                    }
                }
            },
            {
                data: 'id',
                render: function(data, type, row) {
                    var encryptedId = row.encrypted_id;
                    var moreInfoUrl = "{{ route('moreInfoupcoming', [ 'id' => ':id' ]) }}".replace(':id', data);
                    var fileReadUrl = "{{ route('fileRead', [ 'id' => ':id' ]) }}".replace(':id', data);
                    var reportsReadUrl = "{{ route('reportsRead', ':id') }}".replace(':id', data);
                    
                    return `
                        <div class="btn-group">
                            <a href="${moreInfoUrl}" class="mr-1 btn btn-info btn-sm text-light" title="More Info">
                                <i class="fas fa-exclamation-circle"></i> 
                            </a>
                            <a href="${fileReadUrl}" class="mr-1 btn btn-success btn-sm" title="File Info">
                                <i class="fas fa-file"></i> 
                            </a>
                            <a href="${reportsReadUrl}" class="mr-1 btn btn-warning btn-sm" title="Pre-Entrance Health Examination Report">
                                <i class="fas fa-file-pdf"></i> 
                            </a>
                            <button class="mr-1 btn btn-danger btn-sm patient-delete" data-id="${encryptedId}" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        // initComplete: function(settings, json) {
        //     var api = this.api();
        //     api.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
        //         cell.innerHTML = i + 1;
        //     });
        // },
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('id', 'tr-' + data.id);
        }
    });
});

$(document).on('click', '.patient-delete', function(e) {
    var id = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
                url: "{{ route('patientDelete', ':id') }}".replace(':id', id),
                success: function(response) {
                    $("#tr-" + id).delay(1000).fadeOut();
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Successfully Deleted!',
                        icon: 'warning',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    if (response.success) {
                        toastr.success(response.message);
                        console.log(response);
                    }
                }
            });
        }
    });
});

</script>