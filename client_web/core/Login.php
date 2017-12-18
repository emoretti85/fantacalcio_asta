<?php 

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();
    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
        elseif(isset($_GET['exitRoom'])){
        	$this->exitRooms($_GET['exitRoom']);
        }
    }
    
    
    private function exitRooms($id){
    	try {
    		$this->db_connection =  new PDO('mysql:host=localhost;dbname=fantacalcio', 'root', '');
    		$this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$this->db_connection->exec("set names utf8");
    		 
    		$stmt = $this->db_connection->prepare("DELETE FROM room where id_utente = :id");
    		$stmt->bindParam(':id', $id);
    		$stmt->execute();
    		
    		$_SESSION['room'] = 'null';

    	} catch (PDOException $e) {
    		echo 'Connessione al db fallita: ' . $e->getMessage();
    	} catch (Exception $ex){
    		echo 'Errore uscita stanza: ' . $ex->getMessage();
    	}
    }
    
    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        // check login form contents
        if (empty($_POST['email'])) {
            $this->errors[] = "Il campo Email è  vuoto.";
        } elseif (empty($_POST['password'])) {
            $this->errors[] = "Il campo Password è vuoto.";
        } elseif (!empty($_POST['email']) && !empty($_POST['password'])) {
        	
        	try {
        		$this->db_connection =  new PDO('mysql:host=localhost;dbname=fantacalcio', 'root', '');
        		$this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        		$this->db_connection->exec("set names utf8");
        	
        		$stmt = $this->db_connection->prepare("SELECT * FROM users where email = :email");
        		$stmt->bindParam(':email', $_POST['email']);
        		$stmt->execute();
        		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        		if(count($rows)==1){
        			if (password_verify($_POST['password'], $rows[0]['password'])) {
        				$_SESSION['id_utente'] = $rows[0]['id'];
        				$_SESSION['user_name'] = $rows[0]['username'];
        				$_SESSION['user_email'] = $rows[0]['email'];
        				$_SESSION['user_login_status'] = 1;
        			} else {
        				throw new Exception("Utente o password errati. Riprova.");
        			}
        		}else{
        			throw new Exception("L'utente non esiste!.");
        		}
        		
        	} catch (PDOException $e) {
        		echo 'Connessione al db fallita: ' . $e->getMessage();
        	} catch (Exception $ex){
        		echo 'Errore login: ' . $ex->getMessage();
        	}
        }
    }
    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "You have been logged out.";
    }
    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
}
?>