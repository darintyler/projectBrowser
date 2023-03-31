<?php
    require_once './model/Settings.php';

    class PhpProject {
        public $repositoryId;
        public $name;
        public $url;
        public $createdDate;
        public $lastPushDate;
        public $description;
        public $numberOfStars;

        public function __construct() {}

        public function save() {
            $dbConnection = new mysqli(
                Settings::$servername
                , Settings::$username
                , Settings::$password
                , Settings::$dbname
            );

            if($dbConnection->connect_error) {
                die("Error: Connection failed: " . $dbConnection->connect_error);
            }

            // ------------------------------
            // INSERT

            $sql = "
                INSERT INTO PhpProjects (
                    repositoryId
                    , name
                    , url
                    , createdDate
                    , lastPushDate
                    , description
                    , numberOfStars
                )
                VALUES (
                    '" . mysqli_real_escape_string($dbConnection, $this->repositoryId) . "'
                    , '" . mysqli_real_escape_string($dbConnection, $this->name) . "'
                    , '" . mysqli_real_escape_string($dbConnection, $this->url) . "'
                    , '" . mysqli_real_escape_string($dbConnection, $this->createdDate) . "'
                    , '" . mysqli_real_escape_string($dbConnection, $this->lastPushDate) . "'
                    , '" . mysqli_real_escape_string($dbConnection, $this->description) . "'
                    , '" . mysqli_real_escape_string($dbConnection, $this->numberOfStars) . "'
                );
            ";

            if($dbConnection->query($sql) === TRUE) {
                if(Settings::$debug) echo nl2br("New record created successfully\n\n");
            } else {
                if(Settings::$debug) echo nl2br("Error creating record: " . $sql . "\n" . $dbConnection->error);

                die("Error creating record: " . mysqli_error($dbConnection));
            }

            // ------------------------------

            $dbConnection->close();
        }
    }
?>