General overview:
	This application uses a backend PHP application to retrieve the most starred PHP projects from GitHub via the GitHub API, saves the data to a MySQL database, and then displays the data in a browsable list via a frontend ReactJS application. 
	
	Visit http://darintyler.com/portfolio/projectBrowsers to see a working example.
	
Backend description:
	- All app requests are routed to "<backend_app_root>/index.php" via .htaccess, and then the appropriate action is taken depending on the request URL. The available endpoints are "<backend_app_path>/projects" to get stored listing of projects, and "<backend_app_path>/reload" to reload the application with fresh data.
	
Installation instructions:
	- Backend: 
		- Deploy the contents of the backend folder to wherever you wish to serve the application from. The frontend and backend apps do not necessarily need to share a directory.
		- The following properties should be defined in an ".env" file located at "<backend_app_root>/.env":
			requestBase=/server/folder/path/to/this/file/ (example: "/projectBrowser/api/v1/")
			servername=myDbAddress (probably "localhost")
			username=myDbUsename
			password=myDbPassword
			dbname=myDbName
		- To turn on/off debugging, toggle the "debug" field in "<backend_app_root>/model/Settings.php".
	
	- Frontend: 
		- Configure the "BACKEND_API_URL" variable in "<frontend_app_root>/index.js" to match your backend deployment. (example: "http://example.com/path/to/my/application/projectBrowser/api/v1/")
		- To configure the homepage of your build, specify a URL via the "homepage" property in "<frontend_app_root>/package.json" prior to building. (example: "homepage": "http://example.com/path/to/my/application/projectBrowser/")
		- To turn on/off debugging, toggle the "DEBUG" variable in "<frontend_app_root>/index.js".
		- Build the application using npm (the command is "npm run build"), then deploy the content of the build directory to whereever you wish to serve the application from. The frontend and backend apps do not necessarily need to share a directory.
		- When running the application for the first time, you will need to press the "reload" icon to get an initial set of data from GitHub (or visit the "reload" endpoint manually, ie "http://example.com/path/to/my/application/projectBrowser/api/v1/reload"). This action will purge any existing application data from the database, and recreate it with fresh data from GitHub.
