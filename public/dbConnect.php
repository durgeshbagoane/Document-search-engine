<?php
//////////////////////////////////////////////////////////////////////////////////////////////////
//                   Sardar Vallabhbhai National Institute of Technology.                       //
//                                                                                              //
// Title:            REST API Demo                                                              //
// File:             dbConnect.php                                                              //
// Since:            14-Mar-2016 : PM 12:29                                                     //
//                                                                                              //
// Author:           Bhavesh Gabani                                                             //
// Email:            ta8@svnit.ac.in                                                            //
//                                                                                              //
/////////////////////////////////////////////////////////////////////////////////////////////////
class dbConnect 
{
    private $conn;

    function __construct() {        
    }

    /**
     * Establishing database connection
     * @return database connection handler
     */
    function connect() 
	{
        include_once 'config.php';

        // Connecting to mysql database
        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Check for database connection error
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        // returing connection resource
        return $this->conn;
    }

}

?>
