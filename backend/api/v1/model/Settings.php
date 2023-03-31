<?php
    class Settings {
        public static $debug = FALSE;

        // DB settings
        public static $servername;
        public static $username;
        public static $password;
        public static $dbname;

        public function __construct() {}
    }

    (new DotEnv('./.env'))->load();

    Settings::$servername = getenv('servername');
    Settings::$username = getenv('username');
    Settings::$password = getenv('password');
    Settings::$dbname = getenv('dbname');
?>