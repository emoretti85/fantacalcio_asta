<?php 

$id = (isset($_POST['idStanza']))?$_POST['idStanza']:null;
$id_admin = (isset($_POST['idAdmin']))?$_POST['idAdmin']:null;

if($id && $id_admin){

    try{
        $conn = new PDO('mysql:host=localhost;dbname=fantacalcio', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");
                 
        $id_stanza=$id;

        $stmt = $conn->prepare("SELECT COUNT(*) as tot FROM room WHERE id=? AND id_utente=?");
        $stmt->execute(array(
            $id_stanza,
            $id_admin
        ));
        
        $out = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($out[0]['tot'] <= 0){
            $statement = $conn->prepare("INSERT INTO room (id, id_utente) VALUES(?, ?)");
            $statement->execute(array(
                $id_stanza,
                $id_admin
            ));
        }
        
        
        $stmt = $conn->prepare("SELECT nome_stanza  FROM rooms WHERE id=?");
        $stmt->execute(array(
            $id_stanza
        ));
        
        $out = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $stmt = $conn->prepare("SELECT u.username FROM room r, users u  WHERE r.id=? AND r.id_utente = u.id");
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
        
        
        echo json_encode($return);
         
    } catch (PDOException $e) {
        echo "Stanza non creata: " . $e->getMessage();
    }
}else{
    echo "Stanza non creata!";
}


?>