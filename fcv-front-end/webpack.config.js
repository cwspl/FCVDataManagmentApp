const webpack = require("webpack");
const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const devMode = process.env.NODE_ENV !== 'production'

var DIST_DIR = path.resolve(__dirname, "dist");
var SRC_DIR = path.resolve(__dirname, "js");
 
module.exports = {
    entry: './js/app.jsx',
    output: {
        path: DIST_DIR,
        filename: "script.js",
        publicPath: ""
    },
    module: {
        rules: [
            {
                test: /\.js?/,
                include: SRC_DIR,
                loaders: "babel-loader",
                query: {
                    presets: ['@babel/react'],
                }
            },
            {
                test: /\.jsx?/,
                include: SRC_DIR,
                loaders: "babel-loader",
                query: {
                    presets: ['@babel/react'],
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
    plugins: [
        new MiniCssExtractPlugin({
            filename: "style.css"
        })
        
    ],
    mode : devMode ? 'development' : 'production'
};