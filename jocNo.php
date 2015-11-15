<?PHP
session_start();
include 'PartidaNo.php';

?>
<html>

<head>
	<?PHP esLletra(); ?>
	<title>Penjat - Jugant</title>
</head>

<body>
	
	<div id="index">
		<form action="index.php" method="POST">
			<input type="submit" name="index" value="Tornar a lapàgina principal"/>
		</form>
	</div>
	
	<div id="benvinguda">
		<?PHP echo 'Estas jugant com a: '.$_SESSION['nom']; ?>
	</div>	
	
<?PHP

if(!empty($_GET["index"]) && !isset($_SESSION['index'])){
	 $_SESSION['index'] = $_GET["index"];
}

if(!empty($_GET["lletra"]) && !isset($_SESSION['lletra'])){
	 $_SESSION['lletra'] = $_GET["lletra"];
}
    
//acció del botó nou joc - reseteja les variables de sessio  
	if(isset($_GET["reset"])){
		unset($_SESSION['intents']);
		//unset($_SESSION['paraula']); 
		unset($_SESSION['hidden']);
		unset($_SESSION['lletres']); 
		unset($_SESSION['repeticio']); 
		unset($_SESSION['missatge']);
		$_SESSION['paraula'] = buscarParaula();
		$_SESSION['hidden'] = creaHidden();
	}
	
 //acció del botó de tornar al index
   if(isset($_SESSION['index'])){
		session_destroy();
    }
    
//si no existeix 'paraula' la crea     
	if(!isset($_SESSION['paraula'])){
		$_SESSION['paraula'] = buscarParaula();
		
		echo implode($_SESSION['paraula']).'<br>';
	}
	else {
		echo 'SENSE CANVI: '.implode($_SESSION['paraula']).'<br>';// print_r($_SESSION['paraula']); echo '</br>';
   }
   comprovarLletra();
?>

	<div id="imatge">
		<?PHP imatge(); ?>
	</div>
	
	<div id="joc">
		<?PHP 
	   //guarda la lletra entrada en un array lletres
	if(!isset($_SESSION['lletres'])){
		$_SESSION['lletres'] = array();
		$_SESSION['lletres'] = guardarLletra();
	}else{
		$_SESSION['lletres'] = guardarLletra();
	}
	echo 'Lletres dites: '.implode('  ',$_SESSION['lletres']);echo '<br>';
	if(!empty($_SESSION['repeticio'])){
		echo $_SESSION['repeticio']; 
		$_SESSION['repeticio'] = '';
		}

//controlador dels intents/errors  
	if(!isset($_SESSION['intents'])){
	  $_SESSION['intents'] = 0;
	}	
			
 //si no existeix 'hidden' la crea     
	if(!isset($_SESSION['hidden'])){
	$_SESSION['hidden'] = array();
	$_SESSION['hidden'] = creaHidden();
		}

	echo implode($_SESSION['hidden']); echo '</br>';
	echo 'Intents: '.$_SESSION['intents']; 
	?>
	</div>	
		
	<div id="missatge">
		<?PHP echo missatge(); 
		guardarPuntuacio();?>
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