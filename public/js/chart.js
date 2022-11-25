const ctx = document.getElementById('searches-chart');

var labels = [];
var values = [];
for(day of chartData) 
{
    labels.push(day.date);
    values.push(day.total);
}

const data = {
    labels: labels,
    datasets: [
      {
        label: 'Recent searches',
        data: values,
        pointStyle: 'circle',
        pointRadius: 10,
        pointHoverRadius: 15
      }
    ]
};



const config = {
    type: 'line',
    data: data,
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: (ctx) => 'Point Style: ' + ctx.chart.data.datasets[0].pointStyle,
        }
      }
    }
};

new Chart(ctx, config);
