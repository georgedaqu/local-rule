"use strict";

import webpack from "webpack";
import path from "path";

const NODE_ENV = process.env.NODE_ENV
	? process.env.NODE_ENV.trim()
	: "development";

const THEME_NAME = "local-rule-theme";

const config = {
	entry: path.join(__dirname, "source/scripts/main"),
	output: {
		path: path.resolve(
			__dirname,
			`wp-content/themes/${THEME_NAME}/scripts/js/`
		),
		filename: "main.js",
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: "babel-loader",
					options: {
						presets: ["@babel/preset-env"],
					},
				},
			},
		],
	},
	optimization: {
		minimize: true,
	},
	plugins: [
		new webpack.ProvidePlugin({
			$: "jquery",
			jQuery: "jquery",
			jquery: "jquery",
		}),
	],
};

if (NODE_ENV === "dev") {
	config.optimization.minimize = false;
}

export default config;
