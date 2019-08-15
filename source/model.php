<?php
    class Model {
        private $db;

        public function __construct($config) {
            $this->db = $this->getDBConn($config);
        }

        private function getDBConn($cfg) {
            $conn = mysqli_connect($cfg::SERVER, $cfg::USER, $cfg::PW, $cfg::DB);

        if (!$conn) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
              
           
        }
        echo"Connecton sucessful!";
        return $conn;
        }

        public function getTask()
    }