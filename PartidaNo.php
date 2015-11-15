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
		$_GET["lletra"] =  strtolower($_GET["lletra"]);
		array_push($_SESSION['lletres'], $_GET["lletra"]);
		if(count(array_unique($_SESSION['lletres']))<count($_SESSION['lletres'])){
			// Array has duplicates
			$_SESSION['lletres'] = array_unique($_SESSION['lletres']);
			$_SESSION['repeticio'] = 'Lletra '.$_GET["lletra"].' ja dita.</br>';
		}
	return $_SESSION['lletres'];
	}
	
	function missatge(){
		if($_SESSION['hidden'] == $_SESSION['paraula'] && $_SESSION['intents']<6){
		$_SESSION['missatge'] = '</br>Has guanyat!';
		}
		else{
			if($_SESSION['intents']>=6){
			$_SESSION['missatge'] = '</br>Has perdut... La paraula era '.implode($_SESSION['paraula']);
			}
		}
	return $_SESSION['missatge'];
}
		function esLletra(){
			if(!ctype_alpha($_GET["lletra"])){
				return '<meta http-equiv="refresh" content="0; url=error.php" />';
			}
		}	
		
	function comprovarLletra() { 
		$_GET["lletra"] =  strtolower($_GET["lletra"]);
		$_SESSION['error']=0;
		for($i=0;$i<count($_SESSION['paraula']);$i++){
			if($_GET["lletra"] == $_SESSION['paraula'][$i]){
				//si coincideix mira si ja esta posada al seu lloc a la paraula amagada
				$_SESSION['hidden'][$i] = $_GET["lletra"];
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
	return  $_SESSION['hidden'];
	}

	
	function boto(){
		if(!empty($_SESSION['missatge'])){
			echo '<input type="submit" value="Envia" disabled/>';
		}else{
			echo '<input type="submit" value="Envia"/>';
		}
	}
	
	function imatge(){
		switch ($_SESSION['intents']) {
			case 0:
				echo '<img id="imatge" src="images/ahorcado0.png">';
				break;
			case 1:
				echo '<img id="imatge" src="images/ahorcado1.png">';
				break;
			case 2:
				echo '<img id="imatge" src="images/ahorcado2.png">';
				break;
			case 3:
				echo '<img id="imatge" src="images/ahorcado3.png">';
				break;
			case 4:
				echo '<img id="imatge" src="images/ahorcado4.png">';
				break;
			case 5:
				echo '<img id="imatge" src="images/ahorcado5.png">';
				break;
			case 6:
				echo '<img id="imatge" src="images/ahorcado6.png">';
				break;
		}
	}


?>

