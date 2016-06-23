module.exports = {
	entry: {
		clients:'./src/Clients.js',
		projects: './src/Projects.js'
	},
	output: {
		path: __dirname+'/public',
		filename: '[name].js'

	},
	module: {
		loaders: [
			{
				test: /\.jsx?$/,
				loader: 'babel'
			}
		]
	}
};
