<?php

include '../config/config.php';

class Database
{

    public $host   = DB_HOST;
    public $user   = DB_USER;
    public $pass   = DB_PASS;
    public $dbname = DB_NAME;

    public $link;
    public $error;

    public function __construct()
    {
        $this->connectDB();
    }

    private function connectDB()
    {

        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if (!$this->link) {
            $this->error = "NO CONNECT" . $this->link->connect_error;
            return false;
        }
    }

    // This Select Data Database

    public function select($query)
    {

        $select_result = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($select_result->num_rows > 0) {
            return $select_result;
        } else {
            return false;
        }
    }

    public function count($query)
    {

        $select_result = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($select_result->num_rows > 0) {
            $row = mysqli_num_rows($select_result);
            return $row;
        } else {
            return false;
        }
    }

    // This insert Data Database

    public function insert($query)
    {

        $insert_result = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($insert_result) {

            return $insert_result;
            exit();
        } else {
            return false;
        }
    }

    // This update Data Database

    public function update($query)
    {

        $update_result = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($update_result) {

            return $update_result;
            exit();
        } else {
            return false;
        }
    }


    // This delete Data Database

    public function delete($query)
    {

        $delete_result = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($delete_result) {

            return $delete_result;
            exit();
        } else {
            return false;
        }
    }
}
