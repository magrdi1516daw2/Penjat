<?php

if(session_id() === '' || !isset($_SESSION)) {
    session_start();
}
include 'Partida.php';
	
  if(!isset($partida)){
	$partida = new Partida();
	
	}
	
?> 

<!DOCTYPE html>
<html>
<meta charset="UTF-8"/>
<head><title>Proves Penjat</title></head>

<body>
    
    <?php $partida->mostraHidden(); 
    echo 'S\'ha cridat a mostrarHidden()'; 
    $partida->guardarLletra(); 
    echo 'S\'ha cridat a guardLletra()'; 
    $partida->comprovarLletra(); 
    echo 'S\'ha cridat a comprovarLletra()'; 
    ?> 

    <div id="joc">
	<form method="GET">
            lletra: 
            <input type="text" name="lletra" maxlength="1" size="1" >
            <input type="submit" value="Envia"/>
            <!-- <input type="submit" name="reset" value="Nou Joc"/> -->
	</form>
    </div>
</body>
</html>


