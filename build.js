import esbuild from 'esbuild'
import {sassPlugin} from 'esbuild-sass-plugin'
import postcss from 'postcss' ;
import autoprefixer from 'autoprefixer' ;

console.log("build scripts files")
esbuild.build({
    entryPoints: ['assets/scripts/app.js'],
    bundle: true,
    minify: true,
    plugins: [
        sassPlugin({
          async transform(source, resolveDir) {
            const {css} = await postcss([autoprefixer]).process(source, {from: undefined})
            return css
          }
        }),
      ],
    outfile: 'dist/app.js'
})
.catch((e) => console.error(e.message))