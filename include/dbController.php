<?php
class DBController {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "ngt_ecom";
    private $from_email='business@regenlife.co';
    private $notification_email='cs@regenlife.com';
    private $conn;

    function __construct() {
        if($_SERVER['SERVER_NAME']=="www.regenlife.co"||$_SERVER['SERVER_NAME']=="regenlife.co"){
            $this->host = "localhost";
            $this->user = "uyh5tgl2oirj3";
            $this->password = "4D|&o362kw7^";
            $this->database = "dbkvsrs2lymy7d";
        }

        $this->conn = $this->connectDB();
    }

    function connectDB() {
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        return $conn;
    }

    function checkValue($value) {
        $value=mysqli_real_escape_string($this->conn, $value);
        return $value;
    }

    function runQuery($query) {
        $result = mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if(!empty($resultset))
            return $resultset;
    }

    function insertQuery($query) {
        $result = mysqli_query($this->conn,$query);
        return $result;
    }

    function from_email(){
        return $this->from_email;
    }

    function numRows($query) {
        $result  = mysqli_query($this->conn,$query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

    function notify_email(){
        return $this->notification_email;
    }
}

