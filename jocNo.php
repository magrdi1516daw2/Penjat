<?PHP
  session_start();
  include 'PartidaNo.php';

  $_SESSION['reset'] = $_GET["reset"];
    $_SESSION['lletra'] = $_GET["lletra"];
    
//acció del botó nou joc - reseteja les variables de sessio  
  if(isset($_SESSION['reset'])){
    session_unset(); 
    $_SESSION['paraula'] = buscarParaula();
    $_SESSION['hidden'] = creaHidden();
     }
      
//si no existeix 'paraula' la crea     
	if(!isset($_SESSION['paraula'])){
		$_SESSION['paraula'] = buscarParaula();
		
		echo implode($_SESSION['paraula']).'<br>';
	}
	else {
		echo 'SENSE CANVI: '.implode($_SESSION['paraula']).'<br>';// print_r($_SESSION['paraula']); echo '</br>';
   }

//guarda la lletra entrada en un array lletres
	if(!isset($_SESSION['lletres'])){
		$_SESSION['lletres'] = array();
		$_SESSION['lletres'] = guardarLletra();
	}else{
		$_SESSION['lletres'] = guardarLletra();
	}
	echo 'Lletres dites: '.implode($_SESSION['lletres']);echo '<br>';
	if(!empty($_SESSION['repeticio'])){
		echo $_SESSION['repeticio']; 
		$_SESSION['repeticio'] = '';
		}

//controlador dels intents/errors  
	if(!isset($_SESSION['intents']) || $_SESSION['intents']>6){
	  $_SESSION['intents'] = 0;
	}

  
	comprovarLletra();
			
 //si no existeix 'hidden' la crea     
	if(!isset($_SESSION['hidden'])){
	$_SESSION['hidden'] = array();
	$_SESSION['hidden'] = creaHidden();
		}

	

	echo implode($_SESSION['hidden']); echo '</br>';
	echo 'Intents: '.$_SESSION['intents'];
?>


<html>

<head>
	<?PHP esLletra(); ?>
	<title>Penjat - Jugant</title>
</head>

<body>
	<div id="imatge">
		<?PHP imatge(); ?>
	</div>
	
	<div id="missatge">
		<?PHP echo missatge(); ?>
	</div>
	
	<div id="formulari">
		<form action="/jocNo.php" method="GET">
			Lletra: 
			<input type="text" name="lletra" maxlength="1" size="1" >
			<?PHP boto(); ?>
			<input type="submit" name="reset" value="Nou Joc"/>
		</form>
	</div>

</body>
</html>