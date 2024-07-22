const darkenedColors = [
  "#B24E4F", // Darkened Light Pink
  "#B2946C", // Darkened Peach
  "#BFB36C", // Darkened Light Yellow
  "#6EBF85", // Darkened Mint Green
  "#6EA9BF", // Darkened Light Blue
  "#7A7F8E", // Darkened Periwinkle
  "#966B74", // Darkened Pink
  "#6E996E", // Darkened Light Green
  "#B24E47", // Darkened Soft Red
  "#B27E6C", // Darkened Light Apricot
  "#9BAE9A", // Darkened Light Lime
  "#8080B2", // Darkened Pale Lilac
  "#947D7D", // Darkened Pastel Rose
  "#B27A72", // Darkened Light Coral
  "#728D7A", // Darkened Aqua
  "#966B86", // Darkened Pink Lavender
  "#B25B5D", // Darkened Salmon Pink
  "#A7789F", // Darkened Pastel Purple
  "#B27A72", // Darkened Pastel Orange
  "#966B86"  // Darkened Lavender
];


const colors = [
  "#E6999A", // Darkened Light Pink
  "#E6C5A3", // Darkened Peach
  "#E6E699", // Darkened Light Yellow
  "#99E6A3", // Darkened Mint Green
  "#99CCE6", // Darkened Light Blue
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
  "#CC8CB3", // Darkened Lavender
];


const pastelColors = [
  "#FFCCCC", // Light Pink
  "#FFE8CC", // Peach
  "#FFFFCC", // Light Yellow
  "#C9FFDB", // Mint Green
  "#CCEDFF", // Light Blue
  "#D6DBF2", // Periwinkle
  "#FFECF0", // Pink
  "#D5EFD5", // Light Green
  "#FFCCCC", // Soft Red
  "#FFE8D5", // Light Apricot
  "#EAF7D5", // Light Lime
  "#D6D6FF", // Pale Lilac
  "#E8B9B9", // Pastel Rose
  "#FCE3D3", // Light Coral
  "#C3F1E6", // Aqua
  "#EAD4E5", // Pink Lavender
  "#FFB3B8", // Salmon Pink
  "#F5D6EB", // Pastel Purple
  "#FFE8E0",  // Pastel Orange
  "#F0BBE8", // Lavender
];


const graficas = {
  'general' : [
       'bar',
       'pie',
       'networkgraph',
       'column-line',
       'packedbubble'
  ],
  'categoria' : [
    'bar',
    'pie',
    'packedbubble'
  ],
};

const typeCharts = {
  'general': {
    'generalpie': {
      'nombre': "Porcentaje RA por categoría",
      "detalle": "",
      "config": "generalpie",
      "posicion": 1,
      "tam": 6,
    },
    'generalbar': {
      'nombre': "Cantidad de RA por categoría",
      "detalle": "",
      "config": "generalbar",
      "posicion": 1,
      "tam": 6,
    },
    'generalnetworkgraph': {
      'nombre': "Resultados de aprendizaje",
      "detalle": "",
      "config": "generalnetworkgraph",
      "posicion": 1,
      "tam": 6,
    },
    'generalpackedbubble': {
      'nombre': "Resultados de aprendizaje por categoría",
      "detalle": "",
      "config": "generalpackedbubble",
      "posicion": 1,
      "tam": 6,
    },
    'generalcolumn-line': {
      'nombre': "Resultados de aprendizaje por bloom",
      "detalle": "",
      "config": "generalcolumn-line",
      "posicion": 1,
      "tam": 6,
    }
  },
  'category': {
    'categorypie': {
      'nombre': "Porcentaje de estrategias por RA",
      "detalle": "",
      "config": "categorypie",
      "posicion": 1,
      "tam": 6,
    },
    'categorybar': {
      'nombre': "Cantidad de RA por categoría",
      "detalle": "",
      "config": "categorybar",
      "posicion": 1,
      "tam": 6,
    }
  }
}

let grapich = {};
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


function generatePDF(id){
  html2canvas(document.getElementById(id), {
    scrollY: -window.scrollY, // Captura todo el contenido, incluido el que está fuera de la vista
    logging: true, // Activa los registros para ver posibles problemas
    useCORS: true // Activa el uso de CORS para capturar imágenes de otros orígenes
}).then(canvas => {
    const imgData = canvas.toDataURL('image/png');
    const pdf = new jsPDF('p', 'mm', 'a4'); // Crea una instancia de jsPDF en orientación portrait ('p') y tamaño A4 ('a4')
    const imgWidth = pdf.internal.pageSize.width;
    let imgHeight = canvas.height * imgWidth / canvas.width;
    
    let yOffset = 0;
    const pageHeight = pdf.internal.pageSize.height;

    while (yOffset < imgHeight) {
        /* if (yOffset !== 0) {
            pdf.addPage();
        } */
        pdf.setFillColor('#e9ecef');
        pdf.rect(0, 0, imgWidth, pageHeight, 'F');
        pdf.addImage(imgData, 'PNG', 0, -yOffset, imgWidth, imgHeight);
        yOffset += pageHeight;
        if (yOffset < imgHeight) {
            pdf.addPage();
        }
    }
    
    // Guarda el documento PDF
    pdf.save('document.pdf');
});
}



