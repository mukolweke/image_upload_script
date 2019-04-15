<?php

class Conn
{
    public $conn;

    public function dbConn()
    {
        try{
            $this->conn = mysqli_connect('127.0.0.1', 'homestead', 'secret', 'image_upload', '3306');
        }catch (mysqli_sql_exception $ex){
            echo "Conn error" . $ex->getMessage();
        }

        return $this->conn;
    }
}
