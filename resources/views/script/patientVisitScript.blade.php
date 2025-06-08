<script>
function visitSearch() {
    var selectedValue = document.getElementById("mySelect").value;
    if (selectedValue) {
        // Disable select to prevent further interaction
        $('#mySelect').prop('disabled', true);

        // Replace 'visitSearch' with the name of your route
        var url = "{{ route('visitSearch', ':id') }}";
        url = url.replace(':id', selectedValue);

        // Redirect after a short delay to allow the UI to update
        setTimeout(function() {
            window.location.href = url;
        }, 100); // 100 ms delay before redirecting
    }
}
</script>

<script>
    $(document).ready(function() {
        let currentPage = 1; // Start from the first page
        let isMoreData = true; // Keep track if there's more data to load
        let isLoading = false; // To prevent multiple AJAX calls simultaneously
    
        function loadBatch() {
            if (!isMoreData || isLoading) return; // Prevent new AJAX if already loading
    
            isLoading = true; // Mark as loading
    
            $.ajax({
                url: "{{ route('patientListOption') }}",
                type: 'GET',
                dataType: 'json',
                data: { page: currentPage },
                success: function(response) {
                    let options = '';
    
                    // Append new options
                    response.data.forEach(patient => {
                        options += `<option value="${patient.id}">${patient.fname} ${patient.lname} ${patient.mname}</option>`;
                    });
                    
                    // Append all at once
                    $('#mySelect').append(options);
                    
                    // Check if more data exists
                    isMoreData = response.pagination.more;
    
                    // Move to the next page if more data is available
                    if (isMoreData) {
                        currentPage++;
                        // Load the next batch after a small delay
                        setTimeout(loadBatch, 200); // 200 ms delay between batches
                    }
    
                    isLoading = false; // Reset loading flag
                }
            });
        }
    
        // Start loading batches
        loadBatch();
    });
    </script>










