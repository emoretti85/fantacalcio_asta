<?php 

$nome = (isset($_POST['nomeStanza']))?$_POST['nomeStanza']:null;
$id_admin = (isset($_POST['idAdmin']))?$_POST['idAdmin']:null;

if($nome && $id_admin){
	
	try{
		$conn = new PDO('mysql:host=localhost;dbname=fantacalcio', 'root', '');
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $conn->exec("set names utf8");
	    
	    $statement = $conn->prepare("INSERT INTO rooms (nome_stanza, id_admin, attiva) VALUES(?, ?, ?)");
	    $statement->execute(array(
	    		$nome,
	    		$id_admin,
	    		1
	    ));
	    
	    $id_stanza=$conn->lastInsertId();
	    
	    $statement = $conn->prepare("INSERT INTO room (id, id_utente) VALUES(?, ?)");
	    $statement->execute(array(
	    		$id_stanza,
	    		$id_admin
	    ));
	    
	    
	    echo "1";
	    
    } catch (PDOException $e) {
    	echo "Stanza non creata: " . $e->getMessage();
    }
}else{
	echo "Stanza non creata!";
}

?>