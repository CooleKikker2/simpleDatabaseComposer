<?php

    class Insert{
        function __construct($conn, $table, $insertRow, $insertValue){
            if(gettype($insertRow) == "array" && gettype($insertValue) == "array"){
                if(count($insertRow) == count($insertValue)){
                    $this->conn = $conn;
                    $this->table = $table;
                    $this->insertRow = $insertRow;
                    $this->insertValue = $insertValue;
                }else{
                    die("<p style='color:red'>Insert failed. Size of the two arrays are diffrent. Add one value per row.");
                }
            }else{
                die("<p style='color:red'>Insert failed. Insert data needs to be an array. Use an array as second and third parameter.");
            }
        }

        function insertValues(){
            //Generate query using given values
            $query = "INSERT INTO `$this->table`(";
            foreach($this->insertRow as $row){
                $query .= '`' .$row . '`, ';
            }
            $query = substr_replace($query, "", -2);
            $query .= ') VALUES (';
            foreach($this->insertValue as $value){
                $query .= '"' .$value . '", ';
            }
            $query = substr_replace($query, "", -2);
            $query .= ')';
            //Sending query to connection
            if($this->conn->query($query)){
                return(1);
            }else{
                die("<p style='color:red'>Insert failed. The error is:<b> " . $this->conn->error ."</b></p>");
            }
        }
    }


?>