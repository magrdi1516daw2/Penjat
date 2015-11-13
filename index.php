<?PHP
  session_start();
  include 'Partida.php';
  
//acció del botó nou joc - reseteja les variables de sessio  
  if($_GET['reset']){
    session_unset(); 
    }
    
//si no existeix 'paraula' la crea     
if(!isset($_SESSION['paraula'])){
	$_SESSION['paraula'] = array();
	$_SESSION['paraula'] = buscarParaula($_SESSION['arxiu']);
	echo $_SESSION['paraula'];
	//print_r($_SESSION['paraula']);
	echo '<br>';
  }else {
    echo 'SENSE CANVI: '.$_SESSION['paraula'].'<br>'; //print_r($_SESSION['paraula'].'<br>');
    }
  

 //si no existeix 'hidden' la crea     
if(!isset($_SESSION['hidden'])){
  $_SESSION['hidden'] = creaHidden($_SESSION['paraula']); 
  }
    else {
    echo 'NO CREA '.$_SESSION['hidden'].'<br>'; 
    }
 
  
  //array lletres
  if(!isset($_SESSION['lletres'])){
	  $_SESSION['lletres'] = array();
		guardarLletra($_SESSION['lletres']);    
  }else{
	  guardarLletra($_SESSION['lletres']);
	  }
	  
 if(!isset($_SESSION['intents'])){
	  $_SESSION['intents'] = 0;
	  comprovarLletra($_SESSION['paraula'], $_SESSION['hidden'],$_SESSION['intents']);
  }else{
	comprovarLletra($_SESSION['paraula'], $_SESSION['hidden'],$_SESSION['intents']);
}

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
