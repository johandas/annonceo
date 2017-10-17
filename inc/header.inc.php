<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Annonceo</title>

  <!-- Bootstrap -->
  <link href="<?= RACINE_SITE ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= RACINE_SITE ?>css/styleperso.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Annonceo</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
              <li class="active"><a href="">Qui Sommes Nous? <span class="sr-only">(current)</span></a></li>
              <li><a href="#">Contact</a></li>
          </ul>
          <form class="navbar-form navbar-left">
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="Recherche...">
              </div>
              <button type="submit" class="btn btn-default">Rechercher</button>
          </form>
                <ul class="nav navbar-nav navbar-right">
                  <?php if(userConnect()) : ?>
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Espace membre <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="connexion.php?action=deconnexion">Déconnexion</a></li>
                            <li><a href="profil.php">Profil</a></li>
                          </ul>
                    </li>
                  <?php else : ?>
                  <ul class="nav navbar-nav">
                      <li><a href="inscription.php">Inscription</a></li>
                      <li><a href="connexion.php">Connexion</a></li>
                  </ul>
                <?php endif; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
<div class="container-fluid">
