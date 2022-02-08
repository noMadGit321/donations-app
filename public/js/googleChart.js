google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {
    let table = google.visualization.arrayToDataTable(data);
    var options = {
      hAxis: {
        title: 'days'
      },
      vAxis: {
        title: 'donations'
      },
      legend: {position: 'bottom'},
      height: 600
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    chart.draw(table, options);
}
