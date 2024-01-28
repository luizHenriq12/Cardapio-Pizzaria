<?php
class Variedade {	
   
	private $variedadeTable = 'variedades';	
	private $con;
	
	public function __construct($db){
        $this->con = $db;
    }	    
	
	public function variedadeList(){		
		$stmt = $this->con->prepare("SELECT id, nome, imagem, status_var FROM ".$this->variedadeTable. " where status_var=1 order by id");				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}

	public function nomeVariedade($id){		
		$stmt = $this->con->prepare("SELECT nome FROM ".$this->variedadeTable. " WHERE id = ".$id);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		$item = $result->fetch_assoc();
		return $item['nome'];	
	}
}
?>