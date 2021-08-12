var webpack = require('webpack')
module.exports = {
  mode: 'production',
  // purge: [
  //   './resources/views/app.blade.php',
  //   './resources/views/welcome.blade.php',
  //   './resources/js/app.js',
  //   './resources/js/bootstrap.js',
  //   './resources/js/Pages/Dashboard/index.vue',
  //   './resources/Shared/layout.vue',
  // ],
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  darkMode: false, // or 'media' or 'class'
  theme: {
    container: {
      center: true,
    },
    extend: {},
  },
  variants: {
    extend: {
      tableLayout: ['hover', 'focus'],
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    new webpack.DefinePlugin({
      'process.env.NODE_ENV': JSON.stringify('production')
    })
  ],
}
