<?php require('inc/init.inc.php'); ?>
<?php require('inc/header.inc.php');?>

<?php


// traitement pour la déconnexion
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion') { // si une action est demandé dans l'URL et que cette action est "déconnexion" alors on procède à la  déconnexion.
    unset($_SESSION['membre']);
    header('location:connexion.php');
}

// Traitement pour rediriger l'utilisateur s'il est déjà connecté
if(userConnect()) {
    header('location:profil.php');
}
// Formulaire activé ?
// debug() pour vérifier
// Vérifie si les deux champs sont pas vide
// On connecte le membre en enregistrant ses infos dans la session
    //-> Le membre existe-t-il en BDD
    //-> Est-ce que le mot de passe saisi correspond à celui en BDD
    //-> Enregistrement en SESSION
    //-> Redirection vers profil



if(!empty($_POST)) {
    if(!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
        $resultat = $pdo -> prepare("SELECT * FROM membre WHERE pseudo=:pseudo");
        $resultat -> bindParam(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
        $resultat -> execute();

        if($resultat -> rowCount() > 0) { // Ok le pseudo existe bien
            $membre = $resultat -> fetch(PDO::FETCH_ASSOC); // On récupère toutes les infos membre qui souhaite se connecter sous la forme d'un ARRAY
            if($membre['mdp'] == md5($_POST['mdp'])) {
                // si (mdp_crypté_en_BDD == mdp saisi + crypté.. Alors tout est OK!)

                foreach($membre as $indice => $valeur) {
                    if($indice != 'mdp') {
                        $_SESSION['membre'][$indice] = $valeur;
                    }
                }
            debug($membre);
                header('location:profil.php');
            }else {
                $msg .= '<div class="erreur">Pseudo erroné.</div>';
            }
        }else {
                $msg .= '<div class="erreur">Veuillez renseigner un Pseudo et un Mot de passe.</div>';
        }
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-1">
            <h1 class="col-sm-offset-2">Se connecter</h1>
            <form action="#"  method="post">
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="pseudo" placeholder="Pseudo" class="form-control" type="text" id="pseudo"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="mdp" placeholder="Mot de passe" class="form-control" type="text" id="mdp"/></div>
                    </div>
                <div class="form-group">
                    <input  class=" col-md-6 col-sm-offset-3 btn btn-success btn btn-success" type="submit" value="Connexion"/>
                </div>
            </form>
        </div>
    </div>
</div>














<?php require('inc/footer.inc.php');?>
