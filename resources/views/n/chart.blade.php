<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>M charts</title>

    </head>
    <body>
        <div class="container">
            <h2>Metro charts</h2>
            <div>
              <canvas id="myChart"></canvas>
            </div>
          </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [@foreach($data as $t) {{$t->note}}, @endforeach '18','20'],
            datasets: [{
                label: 'Notes', // Name the series
                data: [@foreach($data as $t) {{$t->total}}, @endforeach '0', '0'],
                fill: false,
                borderColor: '#2196f3', // Add custom color border (Line)
                backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
                borderWidth: 1 // Specify bar border width
            }]},
        options: {
        responsive: true, // Instruct chart js to respond nicely.
        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
        scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
        }
    });
        </script>
    </body>
</html>
