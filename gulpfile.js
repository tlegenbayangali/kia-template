let preprocessor = 'sass', // Preprocessor (sass, less, styl); 'sass' also work with the Scss syntax in blocks/ folder.
	fileswatch   = 'html,htm,txt,json,md,woff2' // List of files extensions for watching & hard reload

const { src, dest, parallel, series, watch } = require('gulp')
const browserSync  = require('browser-sync').create()
const bssi         = require('browsersync-ssi')
const ssi          = require('ssi')
const webpack      = require('webpack-stream')
const sass         = require('gulp-sass')
const sassglob     = require('gulp-sass-glob')
const cleancss     = require('gulp-clean-css')
const autoprefixer = require('gulp-autoprefixer')
const rename       = require('gulp-rename')
const imagemin     = require('gulp-imagemin')
const newer        = require('gulp-newer')
const rsync        = require('gulp-rsync')
const del          = require('del')
const webp         = require('gulp-webp')
const eslint	   = require('gulp-eslint')
function browsersync() {
	browserSync.init({
		server: {
			baseDir: 'app/',
			middleware: bssi({ baseDir: 'app/', ext: '.html' })
		},
		ghostMode: { clicks: false },
		notify: false,
		online: true,
		open: false,
		// tunnel: 'yousutename', // Attempt to use the URL https://yousutename.loca.lt
	})
}

function scripts() {
	return src(['app/js/**/*.js', '!app/js/*.min.js', '!app/js/utils/**/*', '!app/js/modules/**/*'])
		.pipe(eslint())
		.pipe(eslint.format())
		.pipe(webpack({
			mode: 'production',
			performance: { hints: false },
			module: {
				rules: [
					{
						test: /\.(js)$/,
						exclude: /(node_modules)/,
						loader: 'babel-loader',
						query: {
							presets: ['@babel/env'],
							plugins: ['babel-plugin-root-import']
						}
					}
				]
			}
		})).on('error', function handleError() {
			this.emit('end')
		})
		.pipe(rename('app.min.js'))
		.pipe(dest('app/js'))
		.pipe(dest('dist/js'))
}

function styles() {
	return src([`app/styles/${preprocessor}/*.*`, `!app/styles/${preprocessor}/_*.*`])
		.pipe(eval(`${preprocessor}glob`)())
		.pipe(eval(preprocessor)())
		.pipe(autoprefixer({ overrideBrowserslist: ['last 10 versions'], grid: true }))
		.pipe(cleancss({ level: { 1: { specialComments: 0 } },/* format: 'beautify' */ }))
		.pipe(rename({ suffix: ".min" }))
		.pipe(dest('app/css'))
		.pipe(dest('dist/css'))
}

function images() {
	return src('app/images/src/**/*.{jpeg,jpg,png}')
		.pipe(imagemin())
		.pipe(dest('app/images/dist'))
}

function copySvg() {
	return src('app/images/src/**/*.svg')
		.pipe(dest('dist/images/dist'))
}

function buildcopy() {
	return src([
		'{app/js,app/css}/*.min.*',
		'app/images/**/*.*',
		'!app/images/src/**/*',
		'app/fonts/**/*'
	], { base: 'app/' })
	.pipe(dest('dist'))
}

async function buildhtml() {
	let includes = new ssi('app/', 'dist/', '/**/*.html')
	includes.compile()
	del('dist/parts', { force: true })
}

function cleandist() {
	return del('dist/**/*', {
		force: true
	})
}

function cleanImagesDirectory() {
	return del('app/images/dist/**/*.{jpeg,jpg,png,webp}', {
		force: true
	})
}

function startwatch() {
	watch(`app/styles/${preprocessor}/**/*`, { usePolling: true }, styles)
	watch(`dist/styles/${preprocessor}/**/*`, { usePolling: true }, styles)
	watch(['app/js/**/*.js', '!app/js/**/*.min.js'], { usePolling: true }, scripts)
	watch('app/images/src/**/*.{jpg,jpeg,png,webp,svg,gif}', { usePolling: true }, copySvg)
	watch(`app/**/*.{${fileswatch}}`, { usePolling: true }).on('change', browserSync.reload)
}

exports.scripts = scripts
exports.styles  = styles
exports.images  = images
exports.svg  = copySvg
exports.assets  = series(styles, images, scripts)
exports.build   = series(cleandist, styles, buildcopy, buildhtml, scripts)
exports.default = series(cleanImagesDirectory, styles, copySvg, scripts, startwatch)
