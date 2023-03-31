<?php
    require_once './model/Settings.php';
	
    class GitApiService {
		private $url_github = 'https://api.github.com/search/repositories?q=language:php+sort:stars+fork:true';

        public function __construct() {}
		
		public function FetchPhpProjects() {
			if(Settings::$debug) echo nl2br("Called FetchPhpProjects()\n\n");

			// retrieve results from $url_github url, and parse into json object
			$curlHandle = curl_init($this->url_github);
			curl_setopt($curlHandle, CURLOPT_HTTPHEADER, [
				'User-Agent: PhpProjectBrowser'
			]);			
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			$str_response = curl_exec($curlHandle);
			curl_close($curlHandle);
			if(Settings::$debug) {
				echo nl2br("gettype(\$str_response) == " . gettype($str_response) . "\n\n");
				echo nl2br("var_dump(\$str_response) ==\n");
				echo var_dump($str_response);
				echo nl2br("\n\n");
			}

			// put response in a log file (for debugging)
			$file = 'debug-latest-rest-response.log';
			file_put_contents($file, $str_response);
			
			$obj_response = json_decode($str_response);
			if(Settings::$debug) {
				echo nl2br("gettype(\$obj_response) == " . gettype($obj_response) . "\n\n");
				echo nl2br("var_dump(\$obj_response) ==\n");
				echo var_dump($obj_response);
				echo nl2br("\n\n");
			}

			return $obj_response;
		}
    }
?>