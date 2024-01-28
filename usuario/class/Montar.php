<?php
class Montar {	
   
	private $montarTable = 'montar';
	private $catTable = 'variedade';	
	private $con;
	
	public function __construct($db){
        $this->con = $db;
    }	    
	
	public function pizzaList(){		
		$stmt = $this->con->prepare("SELECT id, id_variedades, nome, price, imagem, status FROM ".$this->montarTable. " where status=1 order by id_variedades desc");				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}

	public function pizzaSearch($q){
		$stmt = $this->con->prepare("SELECT id, id_variedades, nome, price, imagem, status FROM ".$this->montarTable. " where status=1 AND name like '%$q%' or description like '%$q%'");				
		$stmt->execute();		
		$result = $stmt->get_result();	
		return $result;
	}

	public function pizzaVariedade($cat){
		$stmt = $this->con->prepare("SELECT id, id_variedades, nome, price, imagem, status FROM ".$this->montarTable. " where status=1 AND id_categoria='$cat'");				
		$stmt->execute();		
		$result = $stmt->get_result();	
		return $result;
	}

	public function nomeVariedade($id){
		$stmt = $this->con->prepare("SELECT c.nome FROM ".$this->montarTable. " as p inner join ".$this->catTable." as c on 
		p.id_variedades = c.id where p.id=".$id);				
		$stmt->execute();		
		$result = $stmt->get_result();
		$teste = $result->fetch_assoce();
		var_dump($result);
		return $teste;
	}
}
?>