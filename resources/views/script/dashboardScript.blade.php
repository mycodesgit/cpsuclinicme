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
                'NO Remarks',
            ],
            datasets: [{
                data: [{{ count($remarks1) }}, {{ count($remarks2) }}, {{ count($remarks3) }}, {{ count($remarks4) }}],
                backgroundColor: ['#00a65a', '#dc3545', '#ffc107', '#17a2b8'],
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
    $(function() {
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

<script>
    $(function() {
        var ctx = document.getElementById('currcollegevisitBarChartMonthh').getContext('2d');

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
        var barColors = collegeAcronymsmonth.map(college => colorMap[college] || 'black');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: collegeAcronymsmonth,
                datasets: [{
                    label: 'Student Patient Visits per College',
                    data: collegeCountsmonth,
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

<script type="text/javascript">
    $(document).ready(function() {
        var complaintsData = {!! json_encode($result) !!};

        if (!complaintsData || complaintsData.length === 0) {
            var complaints = ['Empty'];
            var counts = [1];
            var colors = ['#000000'];

            var canvasId = '#pieChart{{ isset($index) ? $index : 'default' }}';

            var donutData = {
            labels: complaints,
            datasets: [{
                data: counts,
                backgroundColor: colors,
                hoverBackgroundColor: colors
            }]
            };

            var pieChartCanvas = $(canvasId).get(0).getContext('2d');

            var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false,
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
            };

            var pieChart = new Chart(pieChartCanvas, {
            type: 'pie',
            data: donutData,
            options: pieOptions
            });

            var customLegendHtml = '<div class="legend-item" style="display: flex; align-items: center; margin-bottom: 5px;">' +
            '<div class="legend-color-box" style="width: 20px; height: 20px; background-color: #000000; margin-right: 10px;"></div>' +
            '<span class="legend-label">Empty</span>' +
            '</div>';

            $('#customLegend').html(customLegendHtml);

            return;
        }

        // Extracting data from complaintsData
        var complaints = complaintsData.map(item => item.complaint);
        var counts = complaintsData.map(item => item.count);
        var colors = complaintsData.map(item => item.colorcode);

        var canvasId = '#pieChart{{ isset($index) ? $index : 'default' }}';
        //console.log("Canvas ID:", canvasId);

        var donutData = {
            labels: complaints,
            datasets: [{
                data: counts,
                backgroundColor: colors,
                hoverBackgroundColor: colors
            }]
        };

        var pieChartCanvas = $(canvasId).get(0).getContext('2d');

        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false,
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };

        var pieChart = new Chart(pieChartCanvas, {
            type: 'pie',
            data: donutData,
            options: pieOptions
        });

        var customLegendHtml = '';
        for (var i = 0; i < donutData.labels.length; i++) {
            customLegendHtml += '<div class="legend-item" data-index="' + i +
                '" style="display: flex; align-items: center; margin-bottom: 5px; cursor: pointer;">' +
                '<div class="legend-color-box" style="width: 20px; height: 20px; background-color: ' + donutData
                .datasets[0].backgroundColor[i] + '; margin-right: 10px;"></div>' +
                '<span class="legend-label">' + donutData.labels[i] + '</span>' +
                '</div>';
        }

        $('#customLegend').html(customLegendHtml);

        $('.legend-item').on('click', function() {
            var index = $(this).data('index');

            if (index === undefined || index < 0 || index >= donutData.labels.length) {
                return;
            }

            var slice = pieChart.getDatasetMeta(0).data[index];

            slice.hidden = !slice.hidden;

            if (slice.hidden) {
                $(this).find('.legend-label').css('text-decoration', 'line-through');
            } else {
                $(this).find('.legend-label').css('text-decoration', 'none');
            }

            pieChart.update();
        });
    });
</script>
