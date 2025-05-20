<?php 


class Model{
    protected $db;

    public function __construct(){

        try
        {
            //criar uma conexão com o banco de dados
            $this->db = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        }
        catch(Exception $e){

            echo "Falha de conexão: " . $e->getMessage();
        }
    }
}