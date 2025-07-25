<script>
$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var campus = urlParams.get('campus') || ''; 
    var schlyear = urlParams.get('schlyear') || ''; 
    var semester = urlParams.get('semester') || ''; 

    $('.patient-data').DataTable({
        "ajax": {
            "url": "{{ route('getStudentData') }}",
            "data": function(d) {
                d.campus = campus; // Add the campus parameter to the request
                d.schlyear = schlyear; // Add the campus parameter to the request
                d.semester = semester; // Add the campus parameter to the request
            }
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
                    return [row.lname, row.fname, row.mname].filter(Boolean).join(' ');
                }
            },   
            { 
                data: 'stud_id',
                render: function(data, type, row) {
                    return `<strong>${data}</strong>`;
                }
            },
            { data: 'gender' },   
            { data: 'progAcronym' },   
            // { 
            //     data: 'pexam_remarks', 
            //     render: function(data, type, row) {
            //         if (data === 1) {
            //             return '<span class="badge badge-success">Fit for enrollment</span>';
            //         } else if (data === 2) {
            //             return '<span class="badge badge-danger">Not fit for enrollment</span>';
            //         } else if (data === 3) {
            //             return `<span class="badge badge-warning" data-toggle="tooltip" title="${row.pend_reason}">Pending</span>`;
            //         } else {
            //             return '';
            //         }
            //     }
            // },
            {
                data: 'id',
                render: function(data, type, row) {
                    var moreInfoUrl = "{{ route('moreInfo', [ 'id' => ':id' ]) }}".replace(':id', data);
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
                            <button class="mr-1 btn btn-danger btn-sm patient-delete" data-id="${data}" title="Delete">
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
</script>