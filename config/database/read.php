<?php

    class Read{
        function __construct($conn, $table){
            $this->conn = $conn;
            $this->table = $table;
        }

        function readAll($limit){
            if($limit){
                $query = "SELECT * FROM `$this->table` LIMIT $limit";
            }else{
                $query = "SELECT * FROM `$this->table`";
            }
            if($result = $this->conn->query($query)){
                return $result;
            }else{
                die("<p style='color:red'>Reading failed. The error is:<b> " . $this->conn->error ."</b></p>");
            }
        }
    
        function readFromId($id, $limit){
            if($id){
                if($limit){
                    $query = "SELECT * FROM `$this->table` WHERE id=$id LIMIT $limit";
                }else{
                    $query = "SELECT * FROM `$this->table` WHERE id=$id";
                }
                if($result = $this->conn->query($query)){
                    return $result;
                }else{
                    die("<p style='color:red'>Reading failed. The error is:<b> " . $this->conn->error ."</b></p>");
                }
            }else{
                die("<p style='color:red'>Reading failed. You need to give an id using readFromId(). Please use readAll() if you don't want to filter your results!");
            }
        }

        function readFromRow($row, $value, $limit){
            if($limit){
                $query = "SELECT * FROM `$this->table` WHERE `$row`='$value' LIMIT $limit";
            }else{
                $query = "SELECT * FROM `$this->table` WHERE `$row`='$value'";
            }
            
            if($result = $this->conn->query($query)){
                return $result;
            }else{
                die("<p style='color:red'>Reading failed. The error is:<b> " . $this->conn->error ."</b></p>");
            }
        }

    }

?>