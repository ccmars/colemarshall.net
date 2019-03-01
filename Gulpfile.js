// Require
// npm install gulp-sass gulp-postcss autoprefixer cssnano gulp-sourcemaps
var gulp = require("gulp"),
	sass = require("gulp-sass"),
	postcss = require("gulp-postcss"),
	autoprefixer = require("autoprefixer"),
	cssnano = require("cssnano"),
	sourcemaps = require("gulp-sourcemaps");

// Paths
var paths = {
	coleStyle: {
		src: "style/*.scss",
		dest: "style"
	},
	highlightStyle: {
		src: "includes/highlight/styles/*.scss",
		dest: "includes/highlight/styles"
	}
};

// Style
function style(target) {
	return gulp
		.src(paths[target + 'Style'].src)
		.pipe(sourcemaps.init())
		.pipe(sass())
		.on("error", sass.logError)
		.pipe(postcss([autoprefixer(), cssnano()]))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(paths[target + 'Style'].dest));
}

function coleStyle() {
	return style('cole');
}
exports.coleStyle = coleStyle;

function highlightStyle() {
	return style('highlight');
}
exports.highlightStyle = highlightStyle;

// Default
function defaultTask() {
	gulp.watch(paths.coleStyle.src, coleStyle);
	gulp.watch(paths.highlightStyle.src, highlightStyle);
}

exports.default = defaultTask();