const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
module.exports = {
  mode: 'development',
  entry: {
    'js/app' : './src/js/app.js',
    'js/inicio' : './src/js/inicio.js',
    'js/profesores/index' : './src/js/profesores/index.js',
    'js/alumnos/index' : './src/js/alumnos/index.js',
    'js/tutor/index' : './src/js/tutor/index.js',
    'js/asistencia/index' : './src/js/asistencia/index.js',
    'js/seccion/index' : './src/js/seccion/index.js',
    'js/grado/index' : './src/js/grado/index.js',
    'js/solvencia/index' : './src/js/solvencia/index.js',
    'js/pago/index' : './src/js/pago/index.js',
    'js/reporte_asistencia/index' : './src/js/reporte_asistencia/index.js',
    'js/asignacionalumno/index' : './src/js/asignacionalumno/index.js',
    'js/asignacionprofesor/index' : './src/js/asignacionprofesor/index.js',
    'js/reporteconducta/index' : './src/js/reporteconducta/index.js',

  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'public/build')
  },
  plugins: [
    new MiniCssExtractPlugin({
        filename: 'styles.css'
    })
  ],
  module: {
    rules: [
      {
        test: /\.(c|sc|sa)ss$/,
        use: [
            {
                loader: MiniCssExtractPlugin.loader
            },
            'css-loader',
            'sass-loader'
        ]
      },
      {
        test: /\.(png|svg|jpe?g|gif)$/,
        type: 'asset/resource',
      },
    ]
  }
};