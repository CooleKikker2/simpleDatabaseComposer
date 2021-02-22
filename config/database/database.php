<?php
    //Disable Default errors
    //error_reporting(0);

    //Require insert
    require("insert.php");
    require("read.php");

    class Database {
        
        //Define Class Properties
        public $server;
        public $username;
        public $password;
        public $db;
        public $conn;

        //Constructor Functions
        function __construct($server, $username, $password, $db = null){
            //Set SQL server properties
            $this->server = $server;
            $this->username = $username;
            $this->password = $password;
            $this->db = $db;
        }

        //Connect function. Function connects to database using contructor data
        function connect(){
            if($this->db){
                //Set database connection to $this->conn
                $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);

                //Check for connection errors. If errors send error to user screen
                if($this->conn->connect_error){
                    die("<p style='color:red'>Database connection failed. The error is:<b> " . $this->conn->connect_error ."</b></p>");
                }else{
                    //No errors. Return connection to user
                    return $this->conn;
                }
            }else{
                die("<p style='color:red'>Database connection failed. You did'nt specify a database name. Give a database name for connecting or create a new database using \$database->newDatabase(name)</p>");
            }
        }

        function insertRow($table = null, $insertRow = null, $insertValue = null){
            if(isset($table) && isset($insertRow) && isset($insertValue)){
                if($this->conn){
                    //Call insert class and give connection, table and values
                    $insert = new Insert($this->conn, $table, $insertRow, $insertValue);
                    return $insert->insertValues();
                    
                }else{
                    die("<p style='color:red'>Insert failed. No connection found. First connect using \$database->connect()");
                }
            }else{
                die("<p style='color:red'>Insert failed. Could not found insert data. Usage of this command: \$database->insertRow(InsertTable, InsertRowm, InsertValue)"); 
            }
        }

        function readAll($table = null){
            if(isset($table)){
                if($this->conn){
                    $read = new Read($this->conn, $table);
                    return $read->readAll();
                }else{
                    die("<p style='color:red'>Read failed. No connection found. First connect using \$database->connect()"); 
                }
            }else{
                die("<p style='color:red'>Read failed. Could not read data. Usage of this command: \$database->readAll(table)"); 
            }
        }

        function readById($table = null, $id = null){
            if(isset($table) && isset($id)){
                if($this->conn){
                    $read = new Read($this->conn, $table);
                    return $read->readFromId($id);
                }else{
                    die("<p style='color:red'>Read failed. No connection found. First connect using \$database->connect()"); 
                }
            }else{
                die("<p style='color:red'>Read failed. Could not read data. Usage of this command: \$database->readById(table, id)"); 
            }
        }

        function readByRow($table = null, $row = null, $value = null){
            if(isset($table) && isset($row) && isset($value)){
                if($this->conn){
                    $read = new Read($this->conn, $table);
                    return $read->readFromRow($row, $value);
                }else{
                    die("<p style='color:red'>Read failed. No connection found. First connect using \$database->connect()"); 
                }
            }else{
                die("<p style='color:red'>Read failed. Could not read data. Usage of this command: \$database->readByRow(table, row, value)"); 
            }
        }

        function getInsertId(){
            if($this->conn->insert_id){
                return($this->conn->insert_id);
            }else{
                die("<p style='color:red'>Could not get insert id. Did you inserted something?");
            }
        }

        function hash($toHash){
            return password_hash($toHash, PASSWORD_DEFAULT);
        }

        function newDatabase($name){
            $this->conn = new mysqli($this->server, $this->username, $this->password);

            //Check for connection errors. If errors send error to user screen
            if($this->conn->connect_error){
                die("<p style='color:red'>Database connection failed. The error is:<b> " . $this->conn->connect_error ."</b></p>");
            }else{
                $query = "CREATE DATABASE IF NOT EXISTS `$name`";
                if($this->conn->query($query)){
                    $this->db = $name;
                    if($this->closeConnection()){;
                        return $this->connect();
                    }
                }
            }
        }

        function closeConnection(){
            if($this->conn){
                if($this->conn->close()){
                    return(1);
                }else{
                    die("Something went wrong in closing the SQL connection!");
                }
            }
        }

    }


?>