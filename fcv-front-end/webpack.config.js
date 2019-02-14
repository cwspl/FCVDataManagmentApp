const webpack = require("webpack");
const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');

const devMode = process.env.NODE_ENV !== 'production'

var DIST = "./dist/";
var SRC = "./js/";

var DIST_DIR = path.resolve(__dirname, DIST);
var SRC_DIR = path.resolve(__dirname, SRC);
 
module.exports = {
    entry: ["@babel/polyfill", './js/app.jsx'],
    output: {
        path: DIST_DIR,
        filename: "js/[hash].main.js",
        chunkFilename: "js/[hash][name].bundle.js",
        publicPath: DIST
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx)?/,
                include: SRC_DIR,
                loaders: "babel-loader",
                query: {
                    presets: [ '@babel/preset-env', '@babel/react' ],
                    plugins: ['@babel/plugin-transform-runtime', '@babel/plugin-syntax-dynamic-import']
                }
            },
            {
                test: /\.s?[ac]ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    { loader: 'css-loader', options: { url: false } },
                    { loader: 'sass-loader'}
                ],
            },
        ]
    },
    optimization: {
        minimizer: [new UglifyJsPlugin({
            uglifyOptions: {
              output: {
                comments: false
              }
            }
          })],
    },
    
    plugins: [
        new CleanWebpackPlugin(['dist']),
        new MiniCssExtractPlugin({
            filename: "css/[hash].css"
        }),
        new webpack.optimize.ModuleConcatenationPlugin(),
        new webpack.optimize.OccurrenceOrderPlugin(),
        new webpack.HotModuleReplacementPlugin(),
        new webpack.ProvidePlugin({
            'React':     'react',
        }),
        new HtmlWebpackPlugin({
            hash: true,
            minify: true,
            title: 'FCV App',
            filename: './index.html'
        }),
        new HtmlWebpackPlugin({
            hash: true,
            minify: true,
            title: 'FCV App',
            filename: './../index.html'
        }),
    ],
    mode : devMode ? 'development' : 'production'
};