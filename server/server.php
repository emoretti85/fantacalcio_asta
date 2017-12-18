<?php
class Server {
	
	private $action_list = [
		"offerta",
		"lancio_giocatore"
	];
	private $action_args = [
		"offerta"=>["cifra_offerta"],
		"lancio_giocatore"=>["cod_giocatore","offerta_iniziale"]	
	];
	private $request;
	
	function __construct($request) {
		$this->request = $request;
		$this->checkRequest ();
	}
	public function generateOut() {
		require_once ("actions/".$this->request['action'].".action.php");
		return start_action($this->request,microtime(true));
	}
	private function checkRequest() {
		//Controllo che sia stata ricevuta una request
		if (is_array ( $this->request )) {
			//Controllo che sia presente una action
			if(isset($this->request['action'])){
				//Controllo che la action sia tra quelle registrate
				if(in_array($this->request['action'],$this->action_list)){
					//Controllo che i parametri per la action siano presenti
					$checkCnt=0;
					$checkCnt_accepted = count($this->action_args[$this->request['action']]);
					foreach ($this->request as $req_key=>$req){
						if($req=='action')
							continue;
						if(in_array($req_key,$this->action_args[$this->request['action']]))
							$checkCnt++;
					}
					if($checkCnt < $checkCnt_accepted){
						throw new Exception("La richiesta richiede più parametri. \nCod_Errore:Srv_004");
					}					
				}else{
					throw new Exception("La richiesta non può essere soddisfatta. \nCod_Errore:Srv_003");
				}				
			}else{
				throw new Exception("La richiesta non può essere soddisfatta. \nCod_Errore:Srv_002");
			}
		}else{
			throw new Exception("La richiesta non risulta formattata correttamente. \nCod_Errore:Srv_001");
		}
	}
}
?>