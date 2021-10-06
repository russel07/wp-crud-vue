module.exports = {
    filenameHashing: false,
    productionSourceMap: false,
    //publicPath: process.env.NODE_ENV === 'production' ? '/wp-content/plugins/wp-crud-vue/dist/' : 'http://localhost:8081/',
    outputDir: '../dist',
    configureWebpack: {
        devServer: {
            contentBase: '/wp-content/plugins/wp-crud-vue/dist/',
            allowedHosts: ['wp.test'],
            headers: {
                'Access-Control-Allow-Origin': '*'
            },
        },
        externals: {
            jquery: 'jQuery'
        },
        output: {
            filename: 'js/[name].js',
            chunkFilename: 'js/[name].js',
        },
    },
    css: {
        extract: {
            filename: 'css/[name].css',
            chunkFilename: 'css/[name].css'
        }
    },
};
