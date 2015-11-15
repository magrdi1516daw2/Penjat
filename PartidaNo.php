<?php 

    	
	function buscarParaula(){
		$arxiu = fopen('paraules.txt','r') or die ('error lectura');
		$i=0;
		while(!feof($arxiu)){
			$linies[$i] = fgets($arxiu);
			$i++;
		}
		array_pop($linies);
		$_SESSION['paraula'] = $linies[rand(0,count($linies)-1)];
		fclose($arxiu);
		$_SESSION['paraula'] = str_split($_SESSION['paraula']);
		array_pop($_SESSION['paraula']);
		//crea hidden a partir de la paraula
  		for($i=0;$i<count($_SESSION['paraula']);$i++){
			$_SESSION['hidden'][$i] = ' _ ';
		}
	return $_SESSION['paraula'];
		
	}
	
	function creaHidden(){
		for($i=0;$i<count($_SESSION['paraula']);$i++){
			$_SESSION['hidden'][$i] = ' _ ';
		}  
	return $_SESSION['hidden'];
	} 
	
	function guardarLletra(){
		$_SESSION['lletra'] =  strtolower($_GET["lletra"]);
		if(ctype_alpha($_SESSION['lletra'])){
			array_push($_SESSION['lletres'], $_SESSION['lletra']);
			if(count(array_unique($_SESSION['lletres']))<count($_SESSION['lletres'])){
			// Array has duplicates
			$_SESSION['lletres'] = array_unique($_SESSION['lletres']);
			$_SESSION['repeticio'] = 'Lletra '.$_SESSION['lletra'].' ja dita.</br>';
		}
	}
	return $_SESSION['lletres'];
	}
	
	function missatge(){
		unset($_SESSION['missatge']);
		if($_SESSION['hidden'] == $_SESSION['paraula'] && $_SESSION['intents']<6){
			$_SESSION['puntuacio']+=100;
		$_SESSION['missatge'] = '</br>Has guanyat! Ara tens '.$_SESSION['puntuacio'].' punts.';
		}
		else{
			if($_SESSION['intents']>=6){
			$_SESSION['missatge'] = '</br>Has perdut... La paraula era '.implode($_SESSION['paraula']);
			}
		}
	return $_SESSION['missatge'];
}
		function esLletra(){
			if(!empty($_GET["lletra"]) && !ctype_alpha($_GET["lletra"])){
				echo '<meta http-equiv="refresh" content="1; url=error.php" />';
			}
			
		}	
		
	function guardarPuntuacio(){
		$linies = file('usuaris.txt');
		$arxivo = fopen('usuaris.txt','w') or die ('Error de lectura');
		$i=0;
		foreach($linies as $usuari){
			$usuari[$i] =  explode(',',$usuari);
			$i++;
			}
		foreach($usuari as $dades){
				if($dades[0] == $_SESSION['nom']){
					$dades[3] = $_SESSION['puntuacio'];
				}
				fwrite($arxivo,implode(',',$usuari));
			}		
			
		 }
		
	function comprovarLletra() { 
		$_SESSION['lletra'] =  strtolower($_GET["lletra"]);
		$_SESSION['error']=0;
		if(ctype_alpha($_SESSION['lletra'])){
			for($i=0;$i<count($_SESSION['paraula']);$i++){
				if($_SESSION['lletra'] == $_SESSION['paraula'][$i]){
					//si coincideix mira si ja esta posada al seu lloc a la paraula amagada
					$_SESSION['hidden'][$i] = $_SESSION['lletra'];
					$_SESSION['error']++;
				}else{
					if($_SESSION['hidden'][$i] != $_SESSION['paraula'][$i]){
					$_SESSION['hidden'][$i] = ' _ ';
					} 
				}
			}
			if(!$_SESSION['error']){
				$_SESSION['intents']++;
			}
		}
	return  $_SESSION['hidden'];
	}
 
	
	function boto(){
		if(!empty($_SESSION['missatge']) || $_SESSION['intents']>=6){
			echo '<input type="submit" value="Envia" disabled/>';
		}else{
			echo '<input type="submit" value="Envia"/>';
		}
	}
	
	function imatge(){
		if(!isset($_SESSION['intents'])){
			echo '<img id="imatge" src="images/ahorcado0.png">';
		}
		else{
			echo '<img id="imatge" src="images/ahorcado'.$_SESSION['intents'].'.png">';
		}

	}


?>
