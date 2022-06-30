"use strict";

import gulp from "gulp";
import webpack from "webpack";
import fse from "fs-extra";
import gutil from "gulp-util";
import browserSync from "browser-sync";
import gulpSass from "gulp-sass";
import nodeSass from "node-sass";
const sass = gulpSass(nodeSass);
import bourbon from "bourbon";
import autoprefixer from "gulp-autoprefixer";
import cleanCSS from "gulp-clean-css";
import notifier from "node-notifier";
import sourcemaps from "gulp-sourcemaps";

import webpackConfig from "./webpack.config.babel";

const THEME_NAME = "local-rule-theme";

const statsLog = {
	colors: true,
	version: false,
	hash: false,
	timings: false,
	chunks: false,
};

export const cleanPaths = (done) => {
	fse.emptyDir(`wp-content/themes/${THEME_NAME}/scripts/css`);
	fse.emptyDir(`wp-content/themes/${THEME_NAME}/scripts/js`);
	done();
};

export function styles() {
	const _sources = ["source/sass/main.scss"];

	if (process.env.CSS_NAME) {
		_sources.push(`source/sass/${process.env.CSS_NAME}.scss`);
	}

	return gulp
		.src(_sources)
		.pipe(sourcemaps.init())
		.pipe(
			sass({
				includePaths: [bourbon.includePaths],
			})
		)
		.on("error", (error) => {
			const errorMessage = `Path: ${error.relativePath} at line ${error.line}`;

			notifier.notify({
				title: "Error: Styles",
				message: errorMessage,
			});

			gutil.log(
				gutil.colors.red("[Styles]"),
				gutil.colors.bgRed(errorMessage)
			);
		})
		.pipe(autoprefixer(["last 15 versions"]))
		.pipe(
			cleanCSS({
				level: {
					1: {
						specialComments: 0,
					},
				},
			})
		)
		.pipe(sourcemaps.write("./"))
		.pipe(gulp.dest(`wp-content/themes/${THEME_NAME}/scripts/css`));
}

export function scripts(done) {
	webpack(webpackConfig, onComplete);

	function onComplete(error, stats) {
		if (error) {
			onError(error);
		} else if (stats.hasErrors()) {
			onError(stats.toString(statsLog));
		} else {
			onSuccess(stats.toString(statsLog));
		}
	}

	function onError(error) {
		notifier.notify({
			title: "Error: Scripts",
			message: "See terminal for more",
		});

		gutil.log(gutil.colors.red("[Scripts]"), "\n" + error);
		done();
	}

	function onSuccess() {
		done();
	}
}

export function browser() {
	browserSync.init(
		[
			`wp-content/themes/${THEME_NAME}/scripts/css/**/*.css`,
			`wp-content/themes/${THEME_NAME}/scripts/js/**/*.js`,
			`wp-content/themes/${THEME_NAME}/**/*.html`,
			`wp-content/themes/${THEME_NAME}/**/*.php`,
			`wp-content/themes/${THEME_NAME}/themes/images/**/*`,
		],
		{
			logPrefix: "",
			proxy: "localhost",
			notify: false,
			open: false,
			port: 3000,
		}
	);
}

export function watch() {
	gulp.watch(["source/sass/**/*.scss", "source/sass/**/*.css"], styles);
	gulp.watch("source/scripts/**/*.js", scripts);
}

const start = gulp.series(
	cleanPaths,
	gulp.parallel(browser, styles, scripts, watch)
);
export default start;
