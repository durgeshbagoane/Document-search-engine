<?php
//////////////////////////////////////////////////////////////////////////////////////////////////
//                   Sardar Vallabhbhai National Institute of Technology.                       //
//                                                                                              //
// Title:            REST API Demo                                                              //
// File:             dbHandler.php                                                              //
// Since:            14-Mar-2016 : PM 12:29                                                     //
//                                                                                              //
// Author:           Bhavesh Gabani                                                             //
// Email:            ta8@svnit.ac.in                                                            //
//                                                                                              //
/////////////////////////////////////////////////////////////////////////////////////////////////
class DbHandler
{
    public $conn;

    function __construct()
    {
        require_once 'dbConnect.php';
        // opening db connection
        $db = new dbConnect();
        $this->conn = $db->connect();
    }

    /**
     * Fetching single record
     */
    public function getOneRecord($query)
    {
        $r = $this->conn->query($query . ' LIMIT 1') or die($this->conn->error . __LINE__);
        return $result = $r->fetch_assoc();
    }


    /**
     * Creating new record
     */
    public function insertIntoTable($obj, $column_names, $table_name)
    {

        $c = (array)$obj;
        $keys = array_keys($c);
        $columns = '';
        $values = '';
        foreach ($column_names as $desired_key) { // Check the obj received. If blank insert blank into the array.
            $columns = $columns . $desired_key . ',';
            $values = $values . "'" . $c[$desired_key] . "',";
        }

        $query = "INSERT INTO " . $table_name . "(" . trim($columns, ',') . ") VALUES(" . trim($values, ',') . ")";
        $r = $this->conn->query($query) or die($this->conn->error . __LINE__);

        if ($r) {
            $new_row_id = $this->conn->insert_id;
            return $new_row_id;
        } else {
            return NULL;
        }
    }

    public function getSession()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $sess = array();
        if (isset($_SESSION['user_id'])) {
            $sess["user_id"] = $_SESSION['user_id'];
        } else {
            $sess["user_id"] = '';

        }
        return $sess;
    }

    public function destroySession()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isSet($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
            $msg = "Logged Out Successfully...";
        } else {
            $msg = "Not logged in...";
        }
        return $msg;
    }

    public function setAutoCommit($status)
    {
        $this->conn->autocommit($status);
    }

    public function commit()
    {
        $this->conn->commit();
    }

    public function rollback()
    {
        $this->conn->rollback();
    }
}

?>
