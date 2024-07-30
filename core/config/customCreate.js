if ($("#generalbar").length) {
  Highcharts.chart(
    "generalbar",
    createChart(
      "Cantidad de RA por categoría",
      "column",
      grapich["generalbar"],
      "Cantidad RA",
      "Cantidad RA"
    )
  );
}

if ($("#generalpie").length) {
  Highcharts.chart(
    "generalpie",
    createChart("Porcentaje RA por categoría", "pie", grapich["generalpie"])
  );
}

if ($("#generalnetworkgraph").length) {
  Highcharts.chart(
    "generalnetworkgraph",
    createChart(
      "Resultados de aprendizaje",
      "networkgraph",
      grapich["generalnetworkgraph"]
    )
  );
}

if ($("#generalpackedbubble").length) {
  Highcharts.chart(
    "generalpackedbubble",
    createChart(
      "Resultados de aprendizaje por categoría",
      "packedbubble",
      grapich["generalpackedbubble"]
    )
  );
}

if ($("#generalcolumn-line").length) {
  Highcharts.chart(
    "generalcolumn-line",
    createChart(
      "Resultados de aprendizaje por bloom",
      "column-line",
      grapich["generalcolumn-line"],
      "Cantidad RA",
      grapich["categories"],
      grapich["nivel"]
    )
  );
}

if ($("#categorypie").length) {
  Highcharts.chart(
    "categorypie",
    createChart(
      "Porcentaje de estrategias por RA",
      "pie",
      grapich["categorypie"]
    )
  );
}

if ($("#categorybar").length) {
  Highcharts.chart(
    "categorybar",
    createChart(
      "Cantidad de RA por categoría",
      "column",
      grapich["categorybar"],
      "Cantidad RA",
      "Cantidad RA"
    )
  );
}

if ($("#categorysolidgauge").length) {
  Highcharts.chart(
    "categorysolidgauge",
    createChart(
      "Porcentaje de niveles por RA",
      "solidgauge",
      grapich["solidgauge"],
      grapich["solidgaugeBack"]
    )
  );
}
