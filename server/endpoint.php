<?php 

$req = $_POST;

$req = [
	"action" => "lancio_giocatore",
	"cod_giocatore"=>001,
	"offerta_iniziale" => 1000
];


if(isset($req['action']) && $req['action']!=''){
	require_once 'server.php';
	try{
		$server = new Server($req);
		echo $server->generateOut();
	}catch (Exception $e) {
    	echo 'Caught exception: ',  $e->getMessage(), "\n";
	}	
}else{
	echo "Impossibile ottenere una risposta dal server.";
}
?>