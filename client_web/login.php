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
       <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Effettua la logIn per proseguire</h1>
            <div class="account-wall">
                <img class="profile-img" src="img/login_profile.png"
                    alt="">
                <form id="login_form" class="form-signin" method="post" action="index.php">
                <input id="email" name="email" type="text" class="form-control" placeholder="Email" required autofocus value="ettoremoretti27@gmail.com">
                <input id="password" name="password" type="password" class="form-control" placeholder="Password" required value="12345">
                <input type="hidden" name="login" value="login">
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Entra</button>
               <!--  <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>-->
                </form>
            </div>
            <a href="#" class="text-center new-account">Crea un account </a>
        </div>
    </div>
</div>
       

        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- jQuery CDN validation plugin -->
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <!-- Bootstrap Js CDN -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/login.js"></script>
        
    </body>
</html>
