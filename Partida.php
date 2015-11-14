<?php 
class Partida {
	public $hidden;
	public $paraula;
	public $intents;
	public $lletra;
	public $lletres;
        
	function __construct() {
           $this->buscarParaula();
            $this->intents = 0;
            
                    }

        
 	public function buscarParaula(){
		$arxiu = fopen('paraules.txt','r') or die ('error lectura');
		$i=0;
		while(!feof($arxiu)){
			$linies[$i] = fgets($arxiu);
			$i++;
		}
		array_pop($linies);
		$this->paraula = $linies[rand(0,count($linies)-1)];
		fclose($arxiu);
		//crea hidden a partir de la paraula
  		for($i=0;$i<strlen($this->paraula);$i++){
			$this->hidden[$i] = ' _ ';
		} 
		array_pop($this->hidden);  
		$this->paraula = str_split($this->paraula);
		echo implode($this->paraula);
 
 }
 
	public function mostraHidden(){
	 	echo '</br>';
	 	echo implode($this->hidden);
		echo '</br>';
		}  
	
	public function guardarLletra(){
		if(ctype_alpha($this->lletra)){
			array_push($this->lletres,  $this->lletra); 
			echo implode($this->lletres);
			echo '</br>'; 
		}	
	}
	
	public function comprovarLletra(){
		if(ctype_alpha($this->lletra)){
			for($i=0;$i<count($this->paraula);$i++){
				if($this->lletra ==  $this->paraula[$i]){
					//si coincideix mira si ja esta posada al seu lloc a la paraula amagada
					$this->hidden[$i] =$this->lletra;
				}else{
					if($this->hidden[$i] != $this->paraula[$i]){
						$this->hidden[$i] = ' _ ';
					}
				}
			}	
		echo $this->intents++; //ha d sumar nomes quan la lletra es erronia
		}
	}
	
}	

