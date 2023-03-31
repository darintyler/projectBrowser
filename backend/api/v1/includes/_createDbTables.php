<?php
    require_once './model/Settings.php';

    // Establish a connectionion to the MySQL database
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
    // DROP
    
    // Read the SQL file contents
    $sql = file_get_contents('./sql/dropPhpProjects.sql');

    // Execute the SQL query
    if($dbConnection->query($sql) === TRUE) {
        if(Settings::$debug) echo nl2br("PhpProjects table dropped successfully\n\n");
    } else {
        if(Settings::$debug) echo nl2br("Error dropping table: " . mysqli_error($dbConnection) . "\n\n");
        
        die("Error dropping table: " . mysqli_error($dbConnection));
    }

    // ------------------------------
    // CREATE

    // Read the SQL file contents
    $sql = file_get_contents('./sql/createPhpProjects.sql');

    // Execute the SQL query
    if($dbConnection->query($sql) === TRUE) {
        if(Settings::$debug) echo nl2br("PhpProjects table created successfully\n\n");
    } else {
        if(Settings::$debug) echo nl2br("Error creating table: " . mysqli_error($dbConnection) . "\n\n");
        
        die("Error creating table: " . mysqli_error($dbConnection));
    }

    // ------------------------------

    // Close the database connection
    $dbConnection->close();
?>