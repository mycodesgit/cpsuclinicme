<script>
    $(function() {
        var donutChartCanvas = $('#donutChartPatient').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Student',
                'Employee',
                'Guest',
            ],
            datasets: [{
                data: [{{ count($pstudent) }}, {{ count($pemployee) }}, {{ count($pguest) }}],
                backgroundColor: ['#00a65a', '#00c0ef', '#3c8dbc'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }

        var donutChartCanvas1 = $('#donutChartRemarks').get(0).getContext('2d')
        var donutData1 = {
            labels: [
                'Fit for enrollment',
                'Not fit for enrollment',
                'Pending',
            ],
            datasets: [{
                data: [{{ count($remarks1) }}, {{ count($remarks2) }}, {{ count($remarks3) }}],
                backgroundColor: ['#00a65a', '#00c0ef', '#3c8dbc'],
            }]
        }
        var donutOptions1 = {
            maintainAspectRatio: false,
            responsive: true,
        }

        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

        new Chart(donutChartCanvas1, {
            type: 'doughnut',
            data: donutData1,
            options: donutOptions1
        })
    });
</script>

<script>
    $(function () {
        var ctx = document.getElementById('currcollegevisitBarChart').getContext('2d');

        // Fixed colors for each college
        var colorMap = {
            'CJE': 'gray',
            'CAS': 'red',
            'CBM': 'pink',
            'CAF': 'green',
            'CCS': 'purple',
            'COE': 'orange',
            'CTE': 'blue'
        };

        // Assign fixed color per acronym; fallback to black if not found
        var barColors = collegeAcronyms.map(college => colorMap[college] || 'black');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: collegeAcronyms,
                datasets: [{
                    label: 'Student Patient Visits per College',
                    data: collegeCounts,
                    backgroundColor: barColors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
