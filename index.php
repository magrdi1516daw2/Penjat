<?php 
session_start();
    
    function guardarUsuari(){
	$_SESSION['validacio'] = true;
	if(!isset($_SESSION['nom'])){
        	if(!empty($_POST["nom"]) || ctype_alpha($_POST["nom"])){
                	$_SESSION['nom']  = $_POST["nom"];
		}else{	
			$_SESSION['validacio'] = false;
		}
        }
	if(!isset($_SESSION['email'])){
            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
		$_SESSION['email']  = $_POST["email"];
            }else{	
		$_SESSION['validacio'] = false;
            }
        }

	if(!isset($_SESSION['contra'])){
            if(!empty($_POST["password"]) || ctype_alnum( $_POST["password"])){
		$_SESSION['contra']  = $_POST["password"];
            }else{	
		$_SESSION['validacio'] = false;
            }
        }
		
	$_SESSION['punts'] = 0;
		
	if(isset($_SESSION['nom']) && isset($_SESSION['email']) && isset($_SESSION['contra']) && !empty($_SESSION['nom'])){
            $_SESSION['dades'] = $_SESSION['nom'].','.$_SESSION['email'].','.$_SESSION['contra'].','.$_SESSION['punts'];
            echo $_SESSION['dades'];
            $_SESSION['usuaris'] = fopen('usuaris.txt','a') or die ('error lectura');
            fwrite($_SESSION['usuaris'],$_SESSION['dades']);
            fwrite($_SESSION['usuaris'], PHP_EOL);
            fclose($_SESSION['usuaris']);
	}
    }
	
    function validarUsuari(){
	if($_SESSION['validacio'] && ctype_alpha($_SESSION['nom'])){
            header('Location:jocNo.php');
	}
	else{
            echo 'Error de validació';
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
                    Nom: <input type="text" name="nom"> </br>
                    E-mail: <input type="text" name="email">
                    <input type="submit" value="JUGAR" value="submit"/></br>
                    Contrasenya: <input type="password" name="password">
                    <?php guardarUsuari();
			validarUsuari();
                    ?>

		</form>
	</div>

</body>
</html>
