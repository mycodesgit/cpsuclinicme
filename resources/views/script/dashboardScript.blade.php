<script>
    $(function () {
        var donutChartCanvas = $('#donutChartPatient').get(0).getContext('2d')
        var donutData        = {
        labels: [
            'Student',
            'Employee',
            'Guest',
        ],
        datasets: [
            {
            data: [{{ count($pstudent) }},{{ count($pemployee) }},{{ count($pguest) }}],
            backgroundColor : ['#00a65a', '#00c0ef', '#3c8dbc'],
            }
        ]
        }
        var donutOptions     = {
        maintainAspectRatio : false,
        responsive : true,
        }
 
        var donutChartCanvas1 = $('#donutChartRemarks').get(0).getContext('2d')
        var donutData1        = {
        labels: [
            'Fit for enrollment',
            'Not fit for enrollment',
            'Pending',
        ],
        datasets: [
            {
            data: [{{ count($remarks1) }},{{ count($remarks2) }},{{ count($remarks3) }}],
            backgroundColor : ['#00a65a', '#00c0ef', '#3c8dbc'],
            }
        ]
        }
        var donutOptions1     = {
        maintainAspectRatio : false,
        responsive : true,
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
 <script type="text/javascript">
     $(document).ready(function () {
        // Complaints with colorcode and counts
        var complaintsData = {!! json_encode($result) !!};
  
        if (!complaintsData || complaintsData.length === 0) {
           document.getElementById('content').innerHTML = "Empty!";
  
           var canvas = $('#pieChart{{ isset($index) ? $index : "default" }}');
           canvas.css('height', '0px');
           canvas.hide();
  
           return;
        }
  
        // Extracting data from complaintsData
        var complaints = complaintsData.map(item => item.complaint);
        var counts = complaintsData.map(item => item.count);
        var colors = complaintsData.map(item => item.colorcode);
  
        var canvasId = '#pieChart{{ isset($index) ? $index : "default" }}';
        console.log("Canvas ID:", canvasId);
  
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
           customLegendHtml += '<div class="legend-item" data-index="' + i + '" style="display: flex; align-items: center; margin-bottom: 5px; cursor: pointer;">' +
              '<div class="legend-color-box" style="width: 20px; height: 20px; background-color: ' + donutData.datasets[0].backgroundColor[i] + '; margin-right: 10px;"></div>' +
              '<span class="legend-label">' + donutData.labels[i] + '</span>' +
              '</div>';
        }
  
        $('#customLegend').html(customLegendHtml);
  
        $('.legend-item').on('click', function () {
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
  