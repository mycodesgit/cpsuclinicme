<script>
    function visitSearch() {
        var selectedValue = document.getElementById("mySelect").value;
        if (selectedValue) {
            $('#mySelect').prop('disabled', true);

            var url = "{{ route('consultPatientVisitSearch', ':id') }}";
            url = url.replace(':id', selectedValue);

            setTimeout(function() {
                window.location.href = url;
            }, 100); 
        }
    }
</script>

<script>
    $(document).ready(function() {
        let currentPage = 1;
        let isMoreData = true;
        let isLoading = false;
    
        function loadBatch() {
            if (!isMoreData || isLoading) return; 
    
            isLoading = true; 
    
            $.ajax({
                url: "{{ route('patientListOption') }}",
                type: 'GET',
                dataType: 'json',
                data: { page: currentPage },
                success: function(response) {
                    let options = '';
                    response.data.forEach(patient => {
                        options += `<option value="${patient.id}">${patient.fname} ${patient.lname} ${patient.mname}</option>`;
                    });
                    $('#mySelect').append(options);
                    isMoreData = response.pagination.more;
    
                    if (isMoreData) {
                        currentPage++;
                        setTimeout(loadBatch, 200);
                    }
    
                    isLoading = false; 
                }
            });
        }
        loadBatch();
    });
</script>










