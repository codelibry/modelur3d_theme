const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

const isDev = process.env.NODE_ENV === 'development';

module.exports = {
    mode: isDev ? 'development' : 'production',

    entry: './src/main.js',

    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: 'main.min.js',
        clean: true, // cleans dist before build
    },

    module: {
        rules: [
            // JS
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: 'babel-loader'
            },

            // SCSS / CSS
            {
                test: /\.(sa|sc|c)ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: { url: false }
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            additionalData: `@use 'src/scss/utilities/rem-converter' as *;`,
                            sassOptions: {
                                includePaths: [path.resolve(__dirname)],
                            }
                        }
                    }
                ]
            },

            // Fonts
            {
                test: /\.(woff2?|ttf|eot|otf)$/i,
                type: 'asset/resource',
                generator: {
                    filename: 'fonts/[name][ext]',
                }
            },

            // Images
            {
                test: /\.(png|jpe?g|gif|webp)$/i,
                type: 'asset/resource',
                generator: {
                    filename: 'images/[name][ext]',
                }
            },

            // Icons
            {
                test: /\.svg$/i,
                type: 'asset/resource',
                generator: {
                    filename: 'icons/[name][ext]',
                }
            }
        ]
    },

    plugins: [
        new MiniCssExtractPlugin({
            filename: 'css/main.min.css'
        })
    ],

    optimization: {
        minimizer: [
            `...`, // keep JS minimizer (Terser)
            new CssMinimizerPlugin()
        ]
    },

    watch: isDev, // enables watch mode
    watchOptions: {
        ignored: /node_modules/,
        aggregateTimeout: 300,
        poll: 1000 // optional, if filesystem events don’t trigger
    },

    stats: {
        warnings: false
    }
};
