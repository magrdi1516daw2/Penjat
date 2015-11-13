<?PHP
  session_start();
  include 'Partida.php';
  $_SESSION['arxiu'] = array("cotxe","patata","boligraf");
  
//acció del botó nou joc - reseteja les variables de sessio  
  if($_GET['reset']){
    session_unset(); 
    }
    
//si no existeix 'paraula' la crea     
if(!isset($_SESSION['paraula'])){
	$_SESSION['paraula'] = array();
	$paraules = $_SESSION['arxiu'];
	$num_paraules = count($paraules);
	$_SESSION['paraula'] = $paraules[rand(0,$num_paraules)];
	echo $_SESSION['paraula'];
	//print_r($_SESSION['paraula']);
	echo '<br>';
  }else {
    echo 'SENSE CANVI: '.$_SESSION['paraula'].'<br>'; //print_r($_SESSION['paraula'].'<br>');
    }
  

 //si no existeix 'hidden' la crea     
if(!isset($_SESSION['hidden'])){
	$_SESSION['hidden'] = array();
		for($i=0;$i<strlen($_SESSION['paraula']);$i++){
		 $_SESSION['hidden'[$i]] = ' _ ';
		 }  
  }
    else {
    echo 'NO CREA '.$_SESSION['hidden'].'<br>'; 
    }
 
  
  //array lletres
  if(!isset($_SESSION['lletres'])){
	 $_SESSION['lletres'] = array();
	 array_push($_SESSION['lletres'],$GET["lletra"]);     
  }else{
	 array_push($_SESSION['lletres'],$GET["lletra"]); 
	  }
	  
 if(!isset($_SESSION['intents'])){
	  $_SESSION['intents'] = 0;
  }
  	   for($i=0;$i<strlen($_SESSION['paraula']);$i++){
			if($_GET["lletra"] == $_SESSION['paraula'[$i]]){
				//si coincideix mira si ja esta posada al seu lloc a la paraula amagada
				$_SESSION['hidden'[$i]] = $_GET["lletra"];
				}
				else{
				//cada cop que entra una lletra que ja esta dita augmenten els intents
				}
			}
		$_SESSION['intents']++;

		echo implode($_SESSION['hidden']).'</br>';
		echo 'Intents: '.$_SESSION['intents'];
?>

<html>

<head><title>sessions</title></head>

<body>
<form action="/index.php" method="GET">
	lletra: 
	<input type="text" name="lletra" maxlength="1" size="1" >
	<input type="submit" value="Envia"/>
	<input type="submit" name="reset" value="Nou Joc"/>
</form>
</body>
</html>
