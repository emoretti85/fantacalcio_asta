<?php 

function start_action($request,$time){
	$datetime = new DateTime();
	$datetime->setTimestamp($time);
	$data_formattata = $datetime->format('d/m/Y H:i:s U');
	
	return "action lancio giocatore arrivata, il: <br/>".$data_formattata."<br/>Equivalente a :<br/>".$time;
}

?>