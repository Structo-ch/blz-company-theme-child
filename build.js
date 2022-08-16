import esbuild from 'esbuild'
import sassPlugin from 'esbuild-plugin-sass'

console.log("build scripts files")
esbuild.build({
    entryPoints: ['assets/scripts/app.js'],
    bundle: true,
    minify: true,
    plugins: [sassPlugin()],
    outfile: 'dist/app.js'
})
.catch((e) => console.error(e.message))