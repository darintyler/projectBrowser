<?php
    require_once './model/Settings.php';

    class PhpProjectService {

        public function __construct() {}

        public function GetPhpProjects() {
            $dbConnection = new mysqli(
                Settings::$servername
                , Settings::$username
                , Settings::$password
                , Settings::$dbname
            );

            if($dbConnection->connect_error) {
                die("Error: Connection failed: " . $dbConnection->connect_error);
            }

            $sql = "
                SELECT 
                    repositoryId
                    , name
                    , url
                    , createdDate
                    , lastPushDate
                    , description
                    , numberOfStars
                FROM PhpProjects
                ORDER BY numberOfStars DESC;
            ";

            $qryResult = $dbConnection->query($sql);

            // fetch the results as an associative array
            $arr_phpProjects = [];
            while($row = $qryResult->fetch_assoc()) {
                $arr_phpProjects[] = $row;
            }

            $dbConnection->close();
            
			return $arr_phpProjects;
        }
    }
?>