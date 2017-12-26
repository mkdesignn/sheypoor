var webpack = require("webpack");
var path = require("path");
var entryPointsPathPrefix = './resources/assets/js';
var entryPointsPathPrefixSass = './resources/assets/sass';
const ExtractTextPlugin = require("extract-text-webpack-plugin");
//const extractCSS = new ExtractTextPlugin('./dist/style/[name].style');

//const extractCSS = new ExtractTextPlugin('stylesheets/[name]-one.style');
// var projectRoot = process.env.PWD; // Absolute path to the project root
// var resolveRoot = path.join("vue-from2", 'node_modules'); // project root/node_modules
module.exports = {

    //entry: ['./resources/assets/js'],
    //entry : [ entryPointsPathPrefix + '/motor/create.js', entryPointsPathPrefix + '/motor/index.js' ],
    entry :{'motorbike-form': entryPointsPathPrefix + '/motorbike/form.js',
            'motorbike-index': entryPointsPathPrefix + '/motorbike/index.js',
            'vendor-js': entryPointsPathPrefix + '/vendor-js.js',
            'admin': entryPointsPathPrefixSass+'/admin.scss',
            'font': entryPointsPathPrefixSass+'/font.scss',
            'loading': entryPointsPathPrefixSass+'/loading.scss',
            'style': entryPointsPathPrefixSass+'/style.scss'
        //'vendor-style': entryPointsPathPrefix + '/vendor-style.js'
    },
    output: {
        path: path.resolve(__dirname, 'public/js'),
        publicPath: "/js/",
        filename: '[name].js'
    },
    //output:{
    //    path: path.resolve(__dirname, 'public/admin'),
    //    publicPath: "public/",
    //    filename:  'app.js'
    //},
    // resolveLoader: {
    //     root: path.join(__dirname, 'node_modules')
    // },
     resolve: {
         modules: [
           path.join(__dirname, "src"),
           "node_modules"
         ]
     },
    module: {
        rules:[
            {
                test: /\.es6$/,
                exclude: /node_modules/,
                loader: "babel-loader",
                query: {
                    presets: ["es2015"]
                }
            },
            {
                test: /\.js$/,
                loader: 'babel-loader',
                query: {
                    presets: ['es2015']
                }
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel-loader'
            },
            // {
            //     test: /\.scss$/,
            //     loaders: ['style-loader', 'css-loader', 'sass-loader']
            // },
            {
                test: /\.css$/,
                loaders:['style-loader', 'style-loader']
            },
            // {
            //    test: /\.style$/,
            //    use: ExtractTextPlugin.extract({
            //        fallback: "style-loader",
            //        use: ["style-loader"]
            //    })
            // },
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: ['css-loader', 'sass-loader'],
                    publicPath: '../js/'
                })
            },
            // {
            //    test: /\.sass$/,
            //    loader: ExtractTextPlugin.extract({
            //        fallback: "style-loader",
            //        loader: ['style-loader', 'style-loader', 'sass-loader']
            //    }),
            // },
            //{
            //    test: /\.scss$/,
            //    use: ExtractTextPlugin.extract({
            //        fallback: "style-loader",
            //        use: "sass-loader"
            //    })
            //},
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.(png|jpg|gif|svg|ttf|woff|eot|woff2)$/,
                use: [
                    {
                        loader: 'file-loader?name=public/fonts/[name].[ext]',
                        options: {}
                    }
                ]
            }
        ]
    },
    plugins: [
        new ExtractTextPlugin("./../style/[name].css")
    ]
}