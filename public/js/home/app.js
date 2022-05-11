//Chart Atendimentos
var options = {
    chart: {
      height:300,
      type: "line",
      stacked: false
    },
    dataLabels: {
      enabled: false
    },

    series: [

      {
        name: 'Acessos',
        type: 'column',
        data: [21, 23, 33, 34, 44, 44, 56, 58, 13, 28, 33, 45]
      },
    ],
    stroke: {
      width: [4, 4, 4]
    },
    plotOptions: {
      bar: {
        columnWidth: "20%"
      }
    },
    xaxis: {
      categories: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
    },
    yaxis: [
      {
        axisBorder: {
          show: true,
        },
        title: {
          text: "Usuários"
        }
      },
      {
        seriesName: 'Column A',
        show: false
      }
    ],
    tooltip: {
      shared: false,
      intersect: true,
      x: {
        show: true
      }
    },
    legend: {
      horizontalAlign: "left",
      offsetX: 40
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart-acessos"), options);

  chart.render();


