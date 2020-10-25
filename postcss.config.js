module.exports = {
    plugins: [
      // ...
      require('tailwindcss'),
      require('autoprefixer'),
      require('@fullhuman/postcss-purgecss')({
          content:[
            // './src/**/*.vue',
            './resources/js/components/*.vue',
            './resources/views/*.*',
            'resources/views/*.php',
          ],
          defaultExtractor: content => content.match(/[A-Za-z0-9-_:/]+/g) || []
      })
      // ...
    ]
  }