<script>
    $(document).ready(function() {
        $('.update-field').on('change', function() {
            var elementType = $(this).prop('tagName').toLowerCase();
            if (elementType === 'input' || elementType === 'textarea') {
                columnid = $(this).data('column-id');
                columnname = $(this).data('column-name');
            } else if (elementType === 'select') {
                columnid = $(this).find('option:selected').data('column-id');
                columnname = $(this).find('option:selected').data('column-name');
            }

            var value = $(this).val();

            $.ajax({
                url: '{{ route("patientUpdate") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: columnid,
                    column: columnname,
                    value: value
                },
                success: function(response) {
                    
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        console.error('Validation errors:', errors);
                    } else {
                        console.error('Error:', error);
                    }
                }
            });
        });
    });

    $(document).ready(function() {
        $('.update-field1').on('change', function() {
        var columnId = $(this).data('column-id');
        var columnName = $(this).data('column-name');
        var value = $(this).val();
        var dataArray = $(this).data('array'); // Add this line

        $.ajax({
            url: "{{ route('patientHistory') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id: columnId,
                column: columnName,
                value: value,
                data_array: dataArray // Add this line
            },
            success: function(response) {
                
            }
        });
    });
});
</script>