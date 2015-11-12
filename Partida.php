<?php 

  	$_SESSION['arxiu'] = array("cotxe","patata","boligraf");
  	
	function buscarParaula($paraules){
		$paraules = $_SESSION['arxiu'];
		$num_paraules = count($paraules);

		return $paraules[rand(0,$num_paraules)];
	}
	
function creaHidden($paraula){
	for($i=0;$i<strlen($paraula);$i++){
		 $hidden[$i] = ' _ ';
		 } 
		 return $hidden;
	} 
	
	function guardarLletra($lletres){
		$lletra = $_GET["lletra"];
		array_push($lletres,$lletra); 
		print_r($lletres);	echo '</br>'; 
		}
			
	function comprovarLletra($paraula,$hidden,$intents) { 
	$lletra = $_GET["lletra"];
	//array_push($lletres,$_GET["lletra"]);  //per cada lletra dita comprova si coincideix amb cada lletra de la paraula 
		for($i=0;$i<strlen($paraula);$i++){
			if($lletra == $paraula[$i]){
				//si coincideix mira si ja esta posada al seu lloc a la paraula amagada
				$hidden[$i] = $lletra;
				}
				else{
				//cada cop que entra una lletra que ja esta dita augmenten els intents
					$intents ++;
					}
			}
			
		

		$intents++;


				echo implode($hidden).'</br>';
				
				echo 'Intents: '.$intents;
		
		}

?>

