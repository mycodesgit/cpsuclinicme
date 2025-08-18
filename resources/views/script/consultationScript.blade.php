<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    $(document).ready(function() {
        $('#adPVisit').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: pvisitCreateRoute,
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                        //console.log(response);
                        $(document).trigger('pvisitAdded');
                        $('#addPatientModal').modal('hide');
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
        var dataTable = $('#consultationTable').DataTable({
            "ajax": {
                "url": "{{ route('getconsultPatientVisitSearch', ['id' => ':id']) }}".replace(':id', studentId),
                "type": "GET",
            },
            destroy: true,
            info: true,
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            "columns": [
                { data: 'date',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY');
                        } else {
                            return data;
                        }
                    }
                 },
                { data: 'time' },
                { data: 'medicines' },
                { data: 'complaint' },
                { data: 'treatment' },
                {
                    data: 'vid',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var buttons = '<a hrefr="#" class="btn btn-sm btn-primary btn-consultaionedit mr-1" data-id="' + row.vid + '" data-toggle="tooltip" data-placement="top" title="Edit Category."><i class="fas fa-pen"></i> </a>';
                            return buttons;
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
        $(document).on('pvisitAdded', function() {
            dataTable.ajax.reload();
        });
    });

    $(document).on('click', '.btn-consultaionedit', function() {
        var id = $(this).data('id');
        var fundName = $(this).data('fundname');
        $('#editFundId').val(id);
        $('#editFundName').val(fundName);
        $('#editConsultationModal').modal('show');
    });
</script>

