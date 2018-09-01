<?php

class Database
{
    private $host;
    private $dbname;
    private $dbuser;
    private $dbpass;
    private $conn;

    public function __construct()
    {
        $this->host = getenv('DB_HOST');
        $this->dbname = getenv('DB_DATABASE');
        $this->dbuser = getenv('DB_USER');
        $this->dbpass = getenv('DB_PASS');
        $this->getConnection();
    }


    public function insert($name, $ipaddr, $filename)
    {
        if (strlen($name) > 20) {
            $name = substr($name, 0, 20);
        }
        $sql = "INSERT INTO `picture` (`name`, `ipaddr`, `filename`) VALUES ('$name', '$ipaddr', '$filename')";
        if (!$this->conn->query($sql)) {
            $this->show_error();
        }else{
            return true;
        }

    }

    public function getRow($name = '')
    {
        $sql = "SELECT * FROM `picture` WHERE `name`='$name'";
        $result = $this->conn->query($sql);
        $files = array();
        if ($result) {
            while ($res = $result->fetch_array()) {
                array_push($files, $res['filename']);
            }
            return $files;
        } else $this->show_error();
    }

    private function getConnection()
    {
        $this->conn = mysqli_connect($this->host, $this->dbuser, $this->dbpass, $this->dbname);
        if (mysqli_connect_error()) {
            die(mysqli_connect_error());
        }
    }

    private function show_error()
    {
  #      echo '<br/>Error number: ' . $this->conn->errno;
        echo '<br/>Mysql error!';
 #       echo '<br/>Error infomation: ' . $this->conn->error;
        die();
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}
