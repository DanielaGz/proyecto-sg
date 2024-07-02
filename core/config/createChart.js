const default_config = {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: "",
  },
  colors: colors,
  credits: {
    enabled: false,
  },
  title: {
    text: "",
    align: "left",
  },
};

function createChart(title, type, data, yAxis = "", xAxis = "", nivel=[]) {
  let default_chart = default_config;
  default_chart.chart.type = type;
  default_chart.title.text = title;
  default_chart.colors = colors;
  switch (type) {
    case "column":
      {
        return createBar(default_chart, data, yAxis);
      }
      break;
    case "pie":
      {
        return createPie(default_chart, data, yAxis, xAxis);
      }
      break;
    case 'column-line':
      {
        return createColumnLine(default_chart, data, yAxis, xAxis , nivel);
      }break;
    case 'solidgauge':
      {
        return createSolidGauge(default_chart, data, yAxis);
      }break;
    case 'packedbubble':
      {
        default_chart.colors = darkenedColors;
        default_chart.height = '100%';
        return createPackedBubble(default_chart, data, yAxis);
      }break; 
    case 'networkgraph':
      {
        return createNetwork(default_chart, data);
      }break;
  }
}

function createBar(default_chart, data, yAxis = "") {
  /* 
  Format data: 
  [
    [
        "PRINCIPIOS DE DISEÑO DE SOFTWARE", -> title
        2 -> cant
    ],
  ]
  */
  return {
    ...default_chart,
    xAxis: {
      type: "category",
      labels: {
        autoRotation: [-45, -90],
        style: {
          fontSize: "13px",
          fontFamily: "Verdana, sans-serif",
        },
      },
    },
    yAxis: {
      min: 0,
      title: {
        text: yAxis,
      },
    },
    legend: {
      enabled: false,
    },
    tooltip: {
      pointFormat: "{point.y}",
    },
    series: [
      {
        name: "Population",
        colorByPoint: true,
        groupPadding: 0,
        data: [...data],
        dataLabels: {
          enabled: false,
          rotation: -90,
          color: "#FFFFFF",
          inside: true,
          verticalAlign: "top",
          y: 10, // 10 pixels down from the top
          style: {
            fontSize: "13px",
            fontFamily: "Verdana, sans-serif",
          },
        },
      },
    ],
  };
}

function createPie (default_chart, data){
  /* 
  Format data:
  [ 
    {
      "name": "PRINCIPIOS DE DISEÑO DE SOFTWARE", -> name
      "y": 2 -> data
    }
  ]
  */
  return {
    ...default_chart,
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        },
        series: {
            borderRadius: 5,
            dataLabels: [{
                enabled: false,
                distance: 15,
                format: '{point.name}'
            }, {
                enabled: false,
                distance: '-30%',
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 5
                },
                style: {
                    fontSize: '0.9em',
                    textOutline: 'none'
                }
            }]
        }
    },
    series: [{
        name: 'Porcentaje',
        colorByPoint: true,
        data: data
    }]
  }
}

function createColumnLine(default_chart, data, yAxis = "", xAxis = [], nivel= []){
  /* 
  Format data:
  [
    {
    "name": "Nivel 1", -> name
    "y": 0, -> cant
    "color": colors['.$count.'],
    "dataLabels": {
        "enabled": true,
        "distance": -50,
        "format": "{point.total}",
        "style": {
            "fontSize": "15px"
        }
    }
  }
  ]

  Format xAxis:
  [
    "PRINCIPIOS DE DISEÑO DE SOFTWARE", -> name
  ]

  Format nivel:
  [
    {
      "type": "column",
      "name": "Nivel 1", -> name
      "data": [ -> cantidad por xAxis
          0,
          0,
          0,
          0,
          0
      ]
    }
  ]
  */
  return {
      ...default_chart,
      title: {
          text: 'Resultados de aprendizaje por bloom',
          align: 'left'
      },
      xAxis: {
          categories: xAxis
      },
      yAxis: {
          title: {
              text: yAxis
          }
      },
      tooltip: {
          valueSuffix: ''
      },
      plotOptions: {
          series: {
              borderRadius: '25%'
          }
      },
      series: [...nivel,{
          type: 'pie',
          name: 'Total',
          data: [...data],
          center: [20, 20],
          size: 100,
          innerSize: '70%',
          showInLegend: false,
          dataLabels: {
              enabled: false
          }
      }]
  }
}

function createSolidGauge(default_chart, data, yAxis= []){
  /* 
  Format data:
  [
    {
    "name": "Nivel 1",
    "data": [
        {
            "color": "#E6999A",
            "radius": "18%",
            "innerRadius": "0%",
            "y": 0
        }
    ]
    }
  ]

  Format yAxis:
  [
    {
    "outerRadius": "18%",
    "innerRadius": "0%",
    "backgroundColor": "#FFCCCC",
    "borderWidth": 0
  }
  ]

  */          
  return {
      ...default_chart,
      tooltip: {
        borderWidth: 0,
        backgroundColor: 'none',
        shadow: false,
        style: {
            border: '1px solid black',
            fontSize: '16px',
            color: "black"
        },
        valueSuffix: '%',
        pointFormat: '{series.name}<br>' +
            '<span style="font-size: 2em; color: black; ' +
            'font-weight: bold">{point.y}</span>',
        positioner: function (labelWidth) {
            return {
                x: (this.chart.chartWidth - labelWidth) / 2,
                y: (this.chart.plotHeight / 2) + 15
            };
        }
    },
    
    pane: {
        startAngle: 0,
        endAngle: 360,
        background: [...yAxis]
    },
    
    yAxis: {
        min: 0,
        max: 80,
        lineWidth: 0,
        tickPositions: []
    },
    
    plotOptions: {
        solidgauge: {
            dataLabels: {
                enabled: false
            },
            linecap: 'round',
            stickyTracking: false,
            rounded: true
        }
    },
    
    series: [...data]
  }
}

function createPackedBubble(default_chart, data, yAxis= []){
  /* 
  Format data:
  [
    {
    "name": "Crea diagramas arquitectónicos que representen visualmente la estructura y el diseño de un sistema de software",
    "data": [
        {
            "name": "Estudio de Casos",
            "value": 400
        },
    ]
    }
  ]

  */          
  return {
      ...default_chart,
        tooltip: {
            useHTML: true,
            pointFormat: '<b>{point.name}</b>'
        },
        plotOptions: {
            packedbubble: {
                minSize: '20%',
                maxSize: '100%',
                zMin: 0,
                zMax: 1000,
                layoutAlgorithm: {
                    gravitationalConstant: 0.05,
                    splitSeries: true,
                    seriesInteraction: false,
                    dragBetweenSeries: false,
                    parentNodeLimit: false
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}',
                    filter: {
                        property: 'y',
                        operator: '>',
                        value: 50
                    },
                    style: {
                        color: 'black',
                        textOutline: 'none',
                        fontWeight: 'normal',
                        fontSize: '10px'
                    }
                }
            }
        },
        series: [...data]
    }
}

function createNetwork (default_chart, data){
  return {
    ...default_chart,
    exporting: {
    allowHTML: true
    },plotOptions: {
          networkgraph: {
              keys: ['from', 'to'],
              layoutAlgorithm: {
                  enableSimulation: true,
                  friction: -0.9
              },
              dataLabels: {
                  enabled: true,
              linkFormat: '',
              style: {
                  fontSize: '12px'
              },
              formatter: function() {
                  // Inicialmente retorna una cadena vacía para ocultar los labels
                  return '';
              }
              },
          },
          series: {
              dataLabels: {
                  enabled: true
              }
          }
      },
      series: [{
          accessibility: {
              enabled: false
          },
          dataLabels: {
              enabled: true,
              linkFormat: '',
              style: {
                  fontSize: '0.9em',
                  fontWeight: 'normal'
              }
          },
          id: 'lang-tree',
          data: [
              ...data
          ]
      }]
  }
}