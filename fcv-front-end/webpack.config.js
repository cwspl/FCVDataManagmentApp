const webpack = require("webpack");
const HtmlWebPackPlugin = require('html-webpack-plugin');
const devMode = process.env.NODE_ENV !== 'production'

module.exports ={
    entry: ['@babel/polyfill', './src/index.js'],
    output: {
        filename: 'js/[name].js',
        chunkFilename: 'js/[name].bundle.js',
    },
    module: {
        rules: [
            {
                test: /\.js?/,
                exclude: /node_modules/,
                loader: 'babel-loader'
            },
            {
                test: /\.(css|scss)$/,
                use: [
                    {
                        loader: 'style-loader'
                    },
                    {
                        loader: 'css-loader',
                        query: { modules: true }
                    },
                    {
                        loader: 'sass-loader',
                        query: { modules: true }
                    }
                ]
            },
            {
                test: /\.(png|svg|jpg)$/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: 'images/[name].[ext]',
                    }}
                ]
            },
            {
                test: /\.(php)$/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: 'includes/[name].[ext]',
                    }}
                ]
            }
        ]
    },
    plugins:[
        new HtmlWebPackPlugin({
            hash: true,
            minify: true,
            appMountId: 'app',
            favicon: './src/assets/favicon.png',
            title: 'FCV App'
        }),
        new webpack.ProvidePlugin({
            'React':     'react',
        }),
    ],
    mode : devMode ? 'development' : 'production'
}