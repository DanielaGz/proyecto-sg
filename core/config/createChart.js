const default_config = {
  chart: {
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

function createChart(title, type, data, yAxis = "", xAxis = "") {
  let default_chart = default_config;
  default_chart.chart.type = type;
  default_chart.title.text = title;
  switch (type) {
    case "column":
      {
        return createBar(default_chart, data, (yAxis = ""), (xAxis = ""));
      }
      break;
    case "a":
      {
      }
      break;
  }
}

function createBar(default_chart, data, yAxis = "", xAxis = "") {
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
      pointFormat: "{point.y:.1f}",
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
