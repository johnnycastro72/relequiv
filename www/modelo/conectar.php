<?php
class conectar{

    protected $db;

    public function conectar(){

    $conn = NULL;

        try{
            $conn = new PDO("mysql:host=localhost;dbname=id9370340_relacion_equivalencia", "id9370340_root", "Algosencillo1", array(PDO::MYSQL_ATTR_FOUND_ROWS => true));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                echo 'Error de conexión a la Base de Datos: ' . $e->getMessage();
                }   
            $this->db = $conn;
    }
   
    public function getConnection(){
        return $this->db;
    }
}

?>