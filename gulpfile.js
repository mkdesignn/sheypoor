const elixir = require('laravel-elixir');
var path = require("path");
//var extract = require("extract-text-webpack-plugin");
require('laravel-elixir-vue-2');
require('laravel-elixir-vueify');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {

    elixir.webpack.mergeConfig({
        output: {
             path: '/',
            //path:'http://panel.ahwazfeed.com',
            publicPath: 'http://localhost:8000/' // Development Server
             //publicPath: "http://panel.ahwazfeed.com/panel/" // Production Server
        },
        module: {
            loaders:[
                {
                    test: /\.js$/,
                    loader: 'buble'
                },
                {
                    test: /\.js$/,
                    loader: 'buble-loader'
                },
                {
                    test: /\.css$/,
                    loader:'style-loader!css2-loader!'
                },
                {
                    test: /\.scss$/,
                    loader: 'style-loader!css2-loader!sass-loader'
                },
                //{
                //    test: /\.scss$/,
                //    use: extract.extract({
                //        fallback: "style-loader",
                //        loader: ['css2-loader', 'sass-loader']
                //    })
                //},
                //{
                //    test: /\.(png|jpg|gif|svg|ttf|woff|eot|woff2)$/,
                //    loader: 'file-loader'
                //},
                {
                    test: /\.vue$/,
                    loader: 'vue-loader'
                }
                //{
                //    loader: 'postcss-loader',
                //    options: {
                //        plugins: () => [ require('autoprefixer')({ browsers: 'last 2 versions' }) ],
                //        sourceMap: true
                //    }
                //}
            ]
        },
        resolve: {
            extensions: ['', '.js', '.vue', '.json', '.css'],
            alias: {
                //'vue$': 'vue/dist/vue.esm.js',
                vue: 'vue/dist/vue.common.js',
                'vue$': 'vue/dist/vue.common.js',
            }
        }
        //plugins: [
        //    new extract("styles.css2")
        //]
    });

    //mix.browserify('./resources/assets/js/app.js', './public/app.js');
    mix.webpack('./resources/assets/js/vendor-js.js', './public/vendor-js.js');
    mix.webpack('./resources/assets/js/vendor-css2.js', './public/vendor-css2.js');

    // factor
    mix.browserify('./resources/assets/js/motor/create.js', './public/motor-create.js');
    mix.webpack('./resources/assets/js/motor/index.js', './public/motor-index.js');

    // formula
    mix.browserify('./resources/assets/js/formula/create.js', './public/formula-create.js');

    // formula item
    mix.browserify('./resources/assets/js/formula/items/create.js', './public/create-item.js');

    //agent
    mix.browserify('./resources/assets/js/agency/create.js', './public/create-agent.js');

    //mix.combine(["./public/motor-index.js","./public/test.js"], './public/js/combined.js');

    //mix.sass('./resources/assets/sass/font.scss', "./public/font.css2");
    //mix.browserify('./resources/assets/js/shared/data-grid.js', './public/data-grid.js');
    //mix.browserify('./resources/assets/js/shared/test.js', './public/test.js');
    //mix.sass('./resources/assets/sass/app.scss', 'public/app.css2')
});
