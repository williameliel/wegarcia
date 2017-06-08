var webpack = require('webpack');
var path = require('path');

var BUILD_DIR = path.resolve(__dirname, 'dist');
var APP_DIR = path.resolve(__dirname, 'src');

var config = {
  entry: APP_DIR + '/index.js',
  output: {
    path: BUILD_DIR,
    filename: 'bundle.js'
  },
  module : {
    loaders : [
      {
        test : /\.jsx?/,
        include : APP_DIR,
        loader : 'babel'
      },
       {
        test: /\.scss$/,
        loader: 'style!css!sass!resolve-url!sass?sourceMap'
      }
    ]
  }

};

module.exports = config;


// var path = require('path');
// var webpack = require('webpack');
// var HtmlWebpackPlugin = require('html-webpack-plugin');
// var ExtractTextPlugin = require('extract-text-webpack-plugin');

// module.exports = {
//     devtool: 'source-map',
//     entry: [
//         'webpack-dev-server/client?http://localhost:3000',
//         'webpack/hot/only-dev-server',
//         './src/index'
//     ],
//     output: {
//         path: path.join(__dirname, 'dist'),
//         filename: 'bundle.js',
//         publicPath: '/'
//     },
//     plugins: [
//         new webpack.HotModuleReplacementPlugin(),
//         new HtmlWebpackPlugin({
//             filename: 'index.html',
//             template: './src/index.template.html',
//             inject: true
//         }),
//         new webpack.NoErrorsPlugin(),
//         new ExtractTextPlugin("style.css", {
//             allChunks: true
//         })
//     ],
//     module: {
//         loaders: [
//             {
//                 test: /\.js$/,
//                 loaders: ['react-hot', 'babel'],
//                 exclude: /node_modules/,
//                 include: __dirname
//             }, {
//                 test: /\.css$/,
//                 loader: ExtractTextPlugin.extract("style-loader", "css-loader")
//             }, {
//                 test: /\.png$/,
//                 loader: "url-loader?limit=100000"
//             }, {
//                 test: /\.jpg$/,
//                 loader: "file-loader"
//             }, {
//                 test: /\.(ttf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
//                 loader: 'file-loader'
//             }
//         ]
//     }
// };