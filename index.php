<?php 
session_start();

	function guardarUsuari(){
				
		if(!empty($_POST["nom"]) || ctype_alpha($_POST["nom"])){
			$_SESSION['nom']  = $_POST["nom"];
		}

		if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			$_SESSION['email']  = $_POST["email"];
		}

		if(!empty($_POST["password"]) || ctype_alnum($_POST["password"])){
			$_SESSION['contra']  = $_POST["password"];
		}
		
		$_SESSIO['puntuacio'] = 0;
		
		/*if(isset($_SESSION['nom']) && isset($_SESSION['email']) && isset($_SESSION['contra'])){
			$_SESSION['dades'] = $_SESSION['nom'].','.$_SESSION['email'].','.$_SESSION['contra'].','.$_SESSION['puntuacio'];
				echo $_SESSION['dades'];
			$_SESSION['usuaris'] = fopen('usuaris.txt','a') or die ('error lectura');
			fwrite($_SESSION['usuaris'],$_SESSION['dades']);
			fwrite($_SESSION['usuaris'], PHP_EOL);
			fclose($_SESSION['usuaris']);
		}*/
		
		if(!empty($_POST["email"]) && !empty($_POST["password"])){
		$linies = file('usuaris.txt') or die ('Error de lectura');
		$i=0;
		foreach($linies as $usuari){
			$_SESSION['usuari'][$i] =  explode(',',$usuari);
			$i++;
			}	
		
		$i=0;
		foreach($_SESSION['usuari'] as $dades){
			if($dades[1] == $_POST["email"] && $dades[2] == $_POST["password"]){
				$_SESSION['nom'] = $dades[0];
				$_SESSION['puntuacio'] = $dades[3];
				header('Location:jocNo.php');
			}
			$i++;
			}
			echo '</br>Error de validació';
		}
	}
	
?>

<html>

<head>
	<title>Penjat - Login</title>
</head>

<body>
	<div id="imatge">
		<img id="imatge" src="images/ahorcado6.png">
	</div>
	
	<div id="missatge">
		El penjat és un joc de paraules per a dues persones o més. L'objectiu és tractar d'endevinar el mot que es pensa un dels participants. Com a pista es col·loca el nombre de lletres. Per torn, es van dient lletres. Si són al mot secret, s'escriuen al seu lloc i si no, s'afegeix un traç al dibuix del penjat. Finalitza el joc quan la persona es penja i s'acaba el dibuix abans d'endevinar la paraula secreta.
	</div>
	
	<div id="formulari">
		<form action="index.php" method="POST">
			Nom: <input type="text" name="nom"></br>
			E-mail: <input type="text" name="email">
			<input type="submit" name="envia" value="Jugar"/></br>
			Contrasenya: <input type="password" name="password">
			<?php guardarUsuari();
				?>

		</form>
	</div>

</body>
</html>
