<?php
    session_start();
    date_default_timezone_set('Asia/Bangkok');

    class db{
        private $ip = "localhost";
        private $user = "root";
        private $pass = "";
        private $db = "sshopbypimkhae";

        public $conn;

        public function __construct()
        {
            $this->db_connect();
        }
        private function db_connect()
        {
            $this->conn = new mysqli($this->ip,$this->user,$this->pass,$this->db);
            $this->conn->query('SET NAMES UTF8');
            return $this->conn;
        }
        public function select($table)
        {
            $sql = "SELECT * FROM $table";
            return $this->conn->query($sql);
        }
        public function select_where($table,$id)
        {
            $sql = "SELECT * FROM $table WHERe $id";
            return $this->conn->query($sql);
        }
        public function select_join($table,$table2,$value)
        {
            $sql = "SELECT * FROM $table LEFT JOIN $table2 ON $table.$value = $table2.$value";
            return $this->conn->query($sql);
        }
        public function select_join_where($table,$table2,$value,$id)
        {
            $sql = "SELECT * FROM $table LEFT JOIN $table2 ON $table.$value = $table2.$value WHERE $id";
            return $this->conn->query($sql);
        }
        public function insert($table,$name,$value)
        {
            $sql = "INSERT INTO $table ($name) VALUES ($value)";
            return $this->conn->query($sql);
        }
        public function update($table,$value,$id)
        {
            $sql = "UPDATE $table SET $value WHERE $id";
            return $this->conn->query($sql);
        }
        public function delete($table,$id)
        {
            $sql = "DELETE FROM $table WHERE $id";
            return $this->conn->query($sql);
        }
        public function alert($mes)
        {
            echo "<script> alert('$mes'); </script>";
        }
        public function header($link)
        {
            header("Refresh:0; url=$link");
        }
        public function header2($link)
        {
            header("Location:$link");
        }
        public function encode($pass)
        {
            return hash_hmac('sha256',$pass,"");
        }
        public function star($star)
        {
            for($i=0;$i<5;$i++)
            {
                if($i<$star)
                {
                    echo "<span class='glyphicon glyphicon-star' style='color:coral;'></span>";
                }
                else
                {
                    echo "<span class='glyphicon glyphicon-star-empty' style='color:coral;'></span>";
                }
            }
        }
        public function id_empty()
        {
            if(empty($_SESSION['id']))
            {
                $this->header2("index.php");
            }
        }
        public function id_not()
        {
            if(!empty($_SESSION['id']))
            {
                $this->header2("index.php");
            }
        }
        public function admin_empty()
        {
            if(empty($_SESSION['id']))
            {
                $this->header2("index.php");
            }
            if($_SESSION['status'] != "admin")
            {
                $this->header2("index.php");
            }
        }
    }
?>