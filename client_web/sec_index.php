<?php
require_once("core/Login.php");

$login = new Login();
$user = null;
$dati_asta = [];

if ($login->isUserLoggedIn() == true) {
	$user = [
			"id_utente" => $_SESSION['id_utente'],
			"username" => $_SESSION['user_name'],
			"email" => $_SESSION['user_email']
	];
	
	require_once ("core/client.php");
	
} else {
	include("login.php");
}

?>

<!doctype html>
<html class="no-js" lang="it">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Fantacalcio - Asta Online</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
        <link rel="apple-touch-icon" href="icon.png">
        <!-- Place favicon.ico in the root directory -->

		<!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        
        <!-- fontawesome -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.1/js/all.js"></script>
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Fantacalcio<br>Asta Online</h3>
                </div>

                <ul class="list-unstyled components">
                    <p>Menu</p>
                    
                    <li id="creaStanza">
                        <a data-toggle="modal" data-target="#creaStanzaModal" href="#">Crea una stanza</a>
                    </li>
                    <li id="accediStanza">
                        <a data-toggle="modal" data-target="#accediStanzaModal" href="#">Accedi ad una stanza</a>
                    </li>
                    
                    <li>
                        <a href="#homeSubmenu">Lancia un Giocatore</a>
                    </li>
                    <li>
                        <a href="#">Asta Attuale</a>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Statistiche</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="#">Giocatore</a></li>
                            <li><a href="#">Squadra</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">La tua rosa</a>
                    </li>
                    <li>
                        <a href="#">Budget Manager</a>
                    </li>
                </ul>

                 <ul class="list-unstyled CTAs">
                 	<li><a href="index.php?exitRoom=<?= $user['id_utente'] ?>" class="download">Esci dalla stanza</a></li>
                    <li><a href="index.php?logout=true" class="download">LogOut</a></li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="navbar-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>

                         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <h2>Utente: <?= $user['username'] ?></h2>
                            </ul>
                        </div>
                    </div>
                </nav>

               
               
     
                <div id="panel_user_connected" class="panel panel-info" style="width: 33%;">
			      <div class="panel-heading">Utenti Connessi all'asta</div>
			      <div id="panel_user_connected_body" class="panel-body">
			      </div>
			    </div>
                 
                <div class="line"></div>
         

            </div>
        </div>
        
        
        
        
        <!-- Modal crea stanza -->
		  <div class="modal fade" id="creaStanzaModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Crea una nuova stanza</h4>
		        </div>
		        <div class="modal-body">
		        	<div id="messaggio_creaStanza"></div>
		           <form id="creaStanzaForm" role="form">
		            <div class="form-group">
		              <label for="nomeStanza"></span> Nome stanza</label>
		              <input type="text" class="form-control" id="nomeStanza" placeholder="Inserisci nome stanza">
		              <input type="hidden" id="idUtente" value="<?= $user['id_utente'] ?>"/>
		            </div>
		            <button  type="submit" class="btn btn-default btn-success btn-block"><i class="fa fa-plus" aria-hidden="true"></i></span> Crea</button>
		          </form>
		        </div>
		        <div class="modal-footer">
		        	<button type="submit" class="btn btn-default btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Chiudi</button>
		        </div>
		      </div>
		      
		    </div>
		  </div>
		  
		  <!-- Modal accedi stanza -->
		  <div class="modal fade" id="accediStanzaModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Accedi ad una stanza</h4>
		        </div>
		        <div class="modal-body">
		         <div id="messaggio_AccediStanza"></div>
		           <form id="accediStanzaForm" role="form">
		            <div class="form-group">
		              <label for="idStanza"></span> Id Stanza</label>
		              <input type="text" class="form-control" id="idStanza" placeholder="Inserisci id stanza">
		              <input type="hidden" id="idUtente" value="<?= $user['id_utente'] ?>"/>
		            </div>
		            <button  type="submit" class="btn btn-default btn-success btn-block"><i class="fa fa-plus" aria-hidden="true"></i></span> Accedi</button>
		          </form>
		        </div>
		        <div class="modal-footer">
		          <button type="submit" class="btn btn-default btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Chiudi</button>
		        </div>
		      </div>
		      
		    </div>
		  </div>
  
        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- Bootstrap Js CDN -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

		<script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                     $(this).toggleClass('active');
                 });
             });
         </script>
    </body>
</html>
