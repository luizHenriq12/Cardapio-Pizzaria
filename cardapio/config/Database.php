<?php
session_start();

class Database{
	
	//private $host  = 'localhost';
    //private $user  = 'root';
    //private $password   = "";
    //private $database  = "calorysistemas_delivery."; 

	private $host  = 'robb0254.publiccloud.com.br';
	private $user  = 'calor_developer';
   	private $password   = "@Samsung2023";
    private $database  = "calorysistemas_delivery"; 
    
    public function getConexao(){		
		$con = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($con->connect_error){
			die("Erro ao conectar ao MySQL: " . $con->connect_error);
		} else {
			return $con;
		}
    }
}
?>