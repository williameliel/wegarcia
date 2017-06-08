/* sw-starter theme webpack config */
const autoprefixer = require('autoprefixer')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const path = require('path')
const webpack = require('webpack');

module.exports = {
    entry: './assets/js/index.js',
    output: {
        filename: 'dist/index.js',
        publicPath : '../'
    },
    devtool: "source-map",
    module: {
        preLoaders: [{
            test:    /\.js$/,
            exclude: /node_modules/,
            loader: 'jscs-loader'
        }],
        loaders: [
        {
           test   : /\.svg$/,
           loader : 'file?name=[path][name].[ext]'
        },
        {
            test: /\.scss$/,
            loader: ExtractTextPlugin.extract('style-loader', [
                    'css-loader?sourceMap',
                    'postcss-loader',
                    'sass-loader?sourceMap'
            ])
        }, {
            test: /\.js?$/,
            exclude: /node_modules/,
            loader: 'babel',
            query: {
                presets: ['es2015']
            }
        }, 

        {   
            test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/, 
            loader: 'file-loader?name=./dist/fonts/[name].[ext]' 
        },
        {   
            test: /\.(ttf|eot|svg)(\?v=[0-9]\.[0-9]\.[0-9])?$/, 
            loader: "file-loader?name=./dist/fonts/[name].[ext]" 
        }

      ]
    },
    plugins: [
        new webpack.ProvidePlugin({
               $: "jquery",
               jQuery: "jquery"
           }),
        new ExtractTextPlugin('./dist/[name].css'),
        new BrowserSyncPlugin({
            // browse to http://localhost:3000/ during development
            host: 'localhost',
            port: 3000,
            notify: false,
            open: false,
            proxy: 'wegarcia.dev', // Replace with your local wordpress link 
        })
    ],
    postcss: [
        autoprefixer({
            browsers: ['last 2 versions']
        })
    ],
    resolve: {
        alias: { 'picker': 'pickadate/lib/picker' }
    }
}
