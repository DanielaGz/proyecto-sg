/**
 * Create a global getSVG method that takes an array of charts as an argument.
 * The SVG is returned as an argument in the callback.
 */
Highcharts.getSVG = function (charts, options, callback) {
  let top = 0,
    width = 0;

  const svgArr = [],
    addSVG = function (svgres) {
      // Grab width/height from exported chart
      const svgWidth = +svgres.match(
          /^<svg[^>]*width\s*=\s*\"?(\d+)\"?[^>]*>/
        )[1],
        svgHeight = +svgres.match(
          /^<svg[^>]*height\s*=\s*\"?(\d+)\"?[^>]*>/
        )[1];

      // Offset the position of this chart in the final SVG
      let svg = svgres.replace("<svg", `<g transform="translate(0,${top})" `);
      svg = svg.replace("</svg>", "</g>");
      top += svgHeight;
      width = Math.max(width, svgWidth);
      svgArr.push(svg);
    },
    exportChart = function (i) {
      if (i === charts.length) {
        return callback(
          `<svg version="1.1" width="${width}" height="${top}"
                            viewBox="0 0 ${width} ${top}"
                            xmlns="http://www.w3.org/2000/svg">
                        ${svgArr.join("")}
                    </svg>`
        );
      }
      charts[i].getSVGForLocalExport(
        options,
        {},
        function () {
          console.log("Failed to get SVG");
        },
        function (svg) {
          addSVG(svg);
          // Export next only when this SVG is received
          return exportChart(i + 1);
        }
      );
    };
  exportChart(0);
};

/**
 * Create a global exportCharts method that takes an array of charts as an
 * argument, and exporting options as the second argument
 */
Highcharts.exportCharts = function (charts, options) {
  options = Highcharts.merge(Highcharts.getOptions().exporting, options);

  // Get SVG asynchronously and then download the resulting SVG
  Highcharts.getSVG(charts, options, function (svg) {
    Highcharts.downloadSVGLocal(svg, options, function () {
      console.log("Failed to export on client side");
    });
  });
};

// Set global default options for all charts
Highcharts.setOptions({
  exporting: {
    // Ensure the export happens on the client side or not at all
    fallbackToExportServer: false,
  },
});

Highcharts.addEvent(Highcharts.Series, "afterSetOptions", function (e) {
  const colorsin = Highcharts.getOptions().colors,
    nodes = {};

  let i = 0;

  if (
    this instanceof Highcharts.Series.types.networkgraph &&
    e.options.id === "lang-tree"
  ) {
    e.options.data.forEach(function (link) {
      if (link[0] === "RESULTADOS APRENDIZAJE") {
        nodes["RESULTADOS APRENDIZAJE"] = {
          id: "RESULTADOS APRENDIZAJE",
          marker: {
            radius: 20,
          },
        };
        nodes[link[1]] = {
          id: link[1],
          marker: {
            radius: 10,
          },
          color: colors[i++],
        };
      } else if (nodes[link[0]] && nodes[link[0]].color) {
        nodes[link[1]] = {
          id: link[1],
          color: nodes[link[0]].color,
        };
      }
    });

    e.options.nodes = Object.keys(nodes).map(function (id) {
      return nodes[id];
    });
  }
});

Highcharts.setOptions({
  lang: {
    contextButtonTitle: "Opciones del gráfico",
    printChart: "Imprimir gráfica",
    downloadPNG: "Descargar PNG",
    downloadJPEG: "Descargar JPEG",
    downloadPDF: "Descargar PDF",
    downloadSVG: "Descargar SVG",
    exitFullscreen: "Salir de pantalla completa",
    viewFullscreen: "Ver en pantalla completa",
  },
});

const colors = [
  "#E6999A", // Darkened Light Pink
  "#E6C5A3", // Darkened Peach
  "#E6E699", // Darkened Light Yellow
  "#99E6A3", // Darkened Mint Green
  "#99CCE6", // Darkened Light Blue
  "#CC8CB3", // Darkened Lavender
  "#A3A8CC", // Darkened Periwinkle
  "#CC9BA6", // Darkened Pink
  "#99CC99", // Darkened Light Green
  "#E69988", // Darkened Soft Red
  "#E6B8A3", // Darkened Light Apricot
  "#C2D1A1", // Darkened Light Lime
  "#9999E6", // Darkened Pale Lilac
  "#B38888", // Darkened Pastel Rose
  "#E6B2A1", // Darkened Light Coral
  "#8CB39A", // Darkened Aqua
  "#CC99B8", // Darkened Pink Lavender
  "#E68088", // Darkened Salmon Pink
  "#D18EB3", // Darkened Pastel Purple
  "#E6B2A3", // Darkened Pastel Orange
];
