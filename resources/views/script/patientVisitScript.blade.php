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


<script>
    $(document).ready(function() {
        $('.student-report').change(function() {
            var selectedId = $(this).val();
            if (selectedId) {
                var url = '{{ route("reportsRead", ":id") }}';
                url = url.replace(':id', selectedId);
                window.location.href = url;
            }
        });
    });
</script>











