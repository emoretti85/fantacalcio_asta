<?php 
require_once("Database.php");


class Asta {
    
    private $db;
    
    function __construct() {
        $this->db = Database::getDb();
    }
    
    function apriAsta(){
        
    }
    
    function lanciaGiocatore(){
        
    }
    
    function rilanciaGiocatore(){
        
    }
    
    function vendiGiocatore(){
        
    }
    
    function sorteggiaTurno(){
        
    }
    
    function aggiornaTurno(){
        
    }
    
    
}



/**
 * Entry
 */

$action = (isset($_POST['action']) && $_POST['action']!='')?$_POST['action']:null;

if($action){

    $asta = new Asta();

    switch ($action) {
        case '':
           
            break;

        case '':
           
            break;
    }
}else{
    echo "Nessuna action ricevuta";
}


?>