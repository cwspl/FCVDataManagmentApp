const webpack = require("webpack");
const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

const devMode = process.env.NODE_ENV !== 'production'

var DIST_DIR = path.resolve(__dirname, "dist");
var SRC_DIR = path.resolve(__dirname, "js");
 
module.exports = {
    entry: ["@babel/polyfill", './js/app.jsx'],
    output: {
        path: DIST_DIR,
        filename: "script.js",
        publicPath: ""
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx)?/,
                include: SRC_DIR,
                loaders: "babel-loader",
                query: {
                    presets: [ '@babel/preset-env', '@babel/react' ],
                    plugins: ['@babel/plugin-transform-runtime']
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
    // devtool: 'source-map',
    optimization: {
        minimizer: [new UglifyJsPlugin({
            uglifyOptions: {
              output: {
                comments: false
              }
            }
          })],
    },
    
    // optimization: {
    //     splitChunks: {
    //         chunks: 'all'
    //     }
    // },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "style.css"
        }),
        new webpack.optimize.ModuleConcatenationPlugin(),
        new webpack.optimize.OccurrenceOrderPlugin(),
        new webpack.HotModuleReplacementPlugin(),
        new webpack.ProvidePlugin({
            'React':     'react',
        }),
    ],
    mode : devMode ? 'development' : 'production'
};