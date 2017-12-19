<?php 
require_once("Database.php");

class Stanza {
    
    private $db;
    
    function __construct() {
        $this->db = Database::getDb();
    }
    
    function creaStanza($nome,$id_admin){
            try{

                $statement = $this->db->prepare("INSERT INTO rooms (nome_stanza, id_admin, attiva) VALUES(?, ?, ?)");
                $statement->execute(array(
                    $nome,
                    $id_admin,
                    1
                ));
                 
                $id_stanza=$this->db->lastInsertId();
                 
                $statement = $this->db->prepare("INSERT INTO room (id, id_utente) VALUES(?, ?)");
                $statement->execute(array(
                    $id_stanza,
                    $id_admin
                ));
                 
                $stmt = $this->db->prepare("SELECT u.username FROM room r, users u  WHERE r.id=? AND r.id_utente = u.id");
                $stmt->execute(array(
                    $id_stanza
                ));
                 
                $out2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
                $return = [
                    "id_stanza"=>$id_stanza,
                    "utenti_connessi"=>$out2
                ];
                return json_encode($return);
                 
                 
            } catch (PDOException $e) {
                return "Stanza non creata: " . $e->getMessage();
            }
    }
    
    function accediStanza($id,$id_admin){
        try{
            $id_stanza=$id;
        
            $stmt = $this->db->prepare("SELECT COUNT(*) as tot FROM room WHERE id=? AND id_utente=?");
            $stmt->execute(array(
                $id_stanza,
                $id_admin
            ));
        
            $out = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($out[0]['tot'] <= 0){
                $statement = $this->db->prepare("INSERT INTO room (id, id_utente) VALUES(?, ?)");
                $statement->execute(array(
                    $id_stanza,
                    $id_admin
                ));
            }
        
        
            $stmt = $this->db->prepare("SELECT nome_stanza  FROM rooms WHERE id=?");
            $stmt->execute(array(
                $id_stanza
            ));
        
            $out = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            $stmt = $this->db->prepare("SELECT u.username FROM room r, users u  WHERE r.id=? AND r.id_utente = u.id");
            $stmt->execute(array(
                $id_stanza
            ));
        
            $out2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            if(isset($out[0]['nome_stanza'])){
                $return = [
                    "nome_stanza"=>$out[0]['nome_stanza'],
                    "utenti_connessi"=>$out2
                ];
            }else{
                die();
            }
        
        
            return json_encode($return);
             
        } catch (PDOException $e) {
            return "Stanza non creata: " . $e->getMessage();
        }
    }
   
}



/**
 * Entry
 */

$action = (isset($_POST['action']) && $_POST['action']!='')?$_POST['action']:null;



if($action){

    $stanza = new Stanza();

    switch ($action) {
        case 'creaStanza':
            $nome = (isset($_POST['nomeStanza']))?$_POST['nomeStanza']:null;
            $id_admin = (isset($_POST['idAdmin']))?$_POST['idAdmin']:null;

            if($nome && $id_admin){
                echo $stanza->creaStanza($nome,$id_admin);
            }else{
                echo "Stanza non creata!";
            }
            break;

        case 'accediStanza':
            $id = (isset($_POST['idStanza']))?$_POST['idStanza']:null;
            $id_admin = (isset($_POST['idAdmin']))?$_POST['idAdmin']:null;

            if($id && $id_admin){
                echo $stanza->accediStanza($id,$id_admin);
            }else{
                echo "Stanza non creata!";
            }
            break;
    }
}else{
    echo "Nessuna action ricevuta";
}
?>