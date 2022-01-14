

google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
    var data = google.visualization.arrayToDataTable([
                    ['Type', 'Amount(L)'],
                    ['O+', 12],
                    ['O-',  5],
                    ['A+',  4],
                    ['A-',  6],
                    ['B+',  7],
                    ['B-',  5],
                    ['AB+', 3],
                    ['AB-', 8]
                ]);

    var options = {
                
        pieHole: 0.4,
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
}