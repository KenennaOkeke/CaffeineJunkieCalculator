const webpack = require('webpack')

module.exports = {
    // ...
    plugins: [
      // ...
      new webpack.DefinePlugin({
        __VUE_OPTIONS_API__: true,
        __VUE_PROD_DEVTOOLS__: true,
      })
    ],
    watch: true,
  }