import path from 'path';

module.exports = {
    module:{
        rules: [{
            test: /\.js$/,
            use:{
                loader: 'babel-loader',
                options: {
                    presets:['babel-preset']
                }
            },           
        }],
         output: {
                 filename: 'bundle.js',
            }
    }
}