<?php

	require_once './lib/DotEnv.php';
    require_once './model/Settings.php';
    require_once './model/Utilities.php';
    require_once './model/GitApiService.php';
    require_once './model/PhpProject.php';
    
	(new DotEnv('./.env'))->load();
	$requestBase = strtolower( getenv('requestBase') ); // read from .env file

    $util = new Utilities();
    $gitApiService = new GitApiService();
	$request = strtolower( $_SERVER['REQUEST_URI'] );

	switch($request) {
	    case $requestBase . 'reload' :
	    case $requestBase . 'reload/' :
            include_once('./includes/_createDbTables.php');
            include_once('./includes/_reload.php');
            
            break;
        case $requestBase . 'projects' :
        case $requestBase . 'projects/' :
            include_once('./includes/_getProjects.php');

            break;
        case $requestBase :
        case $requestBase . '/' :
            echo 'Welcome to Project Browser API v1';

            break;
	    default:
	        http_response_code(404);

	        break;
    }
?>