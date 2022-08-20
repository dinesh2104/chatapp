<?php

class Database{

    public static $conn=null;

    public static function getConnection(){
        if(Database::$conn==null){
            $db_name=get_config("database");
            $username=get_config("username");
            $password=get_config("password");
            $server=get_config("server");
            $connection=new mysqli($server,$username,$password,$db_name);
            if($connection->connect_error){
                die("Database not connected");
            }else{
                Database::$conn=$connection;
                return Database::$conn;
            }

        }else{
            return Database::$conn;
        }


    }

}