<?php
class Produto {	
   
	private $produtosTable = 'produtos';
	private $catTable = 'categorias';	
	private $con;
	
	public function __construct($db){
        $this->con = $db;
    }	    
	
	public function itemsList(){		
		$stmt = $this->con->prepare("SELECT id, name, id_categoria, price, description, images, status FROM ".$this->produtosTable. " where status=1 order by id_categoria desc");				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}

	public function itemsSearch($q){
		$stmt = $this->con->prepare("SELECT id, name, price, description, images, status FROM ".$this->produtosTable. " where status=1 AND name like '%$q%' or description like '%$q%'");				
		$stmt->execute();		
		$result = $stmt->get_result();	
		return $result;
	}

	public function itemsCategorie($cat){
		$stmt = $this->con->prepare("SELECT id, name, price, description, images, status FROM ".$this->produtosTable. " where status=1 AND id_categoria='$cat'");				
		$stmt->execute();		
		$result = $stmt->get_result();	
		return $result;
	}

	public function nomeCategoria($id){
		$stmt = $this->con->prepare("SELECT c.nome FROM ".$this->produtosTable. " as p inner join ".$this->catTable." as c on 
		p.id_categoria = c.id where p.id=".$id);				
		$stmt->execute();		
		$result = $stmt->get_result();
		$teste = $result->fetch_assoc();
		var_dump($result);
		return $teste;
	}

	public function itemsCategorieOrdered($categoriaId) {
		$query = "SELECT * FROM produtos WHERE id_categoria = ? AND status = 1 ORDER BY name ASC";
		$stmt = $this->con->prepare($query);
		$stmt->bind_param("i", $categoriaId);
		$stmt->execute();
		return $stmt->get_result();
	}

	public function getTamanhosPizzas() {
        $query = "SELECT id, name, price FROM ".$this->produtosTable." WHERE id_categoria = 3 AND status = 1 ORDER BY name ASC"; // Supondo que o ID da categoria de pizzas seja 3
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
?>