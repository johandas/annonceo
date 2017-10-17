<?php require('inc/init.inc.php'); ?>
<?php require('inc/header.inc.php'); ?>

<?php

if(!empty($_POST)) {
    $verif_pseudo = preg_match('#^([a-zA-Z-0-9._-]{3,20})$#', $_POST['pseudo']); // Fonction permetant la vérif du pseudo

    if(!empty($_POST['pseudo'])) { // je vérifie le pseudo de l'utilisateur
        if(!$verif_pseudo) { // Si verif_pseudo nous retourne false
                $msg .= '<div class="erreur">Pseudo : Caractères autorisés (A à Z et de 0 à 9), minimun 3 caractères, maximun 20 caractères.</div>';
        } // if(!$verif_pseudo)
    }// fin du if(!empty($_POST['pseudo']))
    else {
            $msg .= '<div class="erreur">Veuillez renseigner un pseudo.</div>';
    } // Fin de la vérif ['pseudo']

        // Vérification du mot de passe !
    $verif_pwd = preg_match('#^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$#', $_POST['mdp']);

    if(!empty($_POST['mdp'])) {
            if(!$verif_pwd) { // Si verif_pseudo nous retourne false
                    $msg .= '<div class="erreur">Mot de passe : Veuillez renseigner 8 caractères minimun (20 max)  au moins une MAJUSCULE et au moins un chiffre.</div>';
            } // fin du if(!$verif_pwd)
    } // fin du if(!empty($_POST['mdp']))
    else {
            $msg .= '<div class="erreur">Veuillez renseigner un mot de passe.</div>';
    } // Fin de la vérif ['mdp']

    $pos = strpos($_POST['email'], '@'); // la position de @
    $ext = substr($_POST['email'], $pos +1); //'gmail.com'
    $ext_non_autorisees = array ('wimsg.com' , 'yopmail.com' , 'mailinator.com' , 'tafmail.com' , 'mvrht.net');

    $verif_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // Vérifie que le format est OK (retourne TRUE si OK) - (FALSE si pas OK)

    if(!empty($_POST['email'])) {

        if(!$verif_email || in_array($ext, $ext_non_autorisees)) {
            $msg .= '<div class="erreur">Veuillez saisir un email valide.</div>';
        }

    }
    else {
            $msg .= '<div class="erreur">Veuillez renseigner un email.</div>';
    }

    if(empty($msg)) {
        $resultat = $pdo -> prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
        $resultat -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $resultat -> execute();

        if($resultat -> rowCount() > 0) { // Signifie que le pseudo est déjà utilisé.
                // Nous aurions pu lui proposer 2/3 variate de son pseudo, en ayant vérifié qu'ils sont disponibles
                $msg .= '<div class="erreur">Le pseudo ' . $_POST['pseudo'] . ' n\'est pas disponible, veuillez choisir un autres pseudo.</div>';

        }
        else { // Ok le pseudo est dispo on va enregistrer le membre dans la BDD .. (Attention , nous devrions également vérifier la disponibilité de l'email)
                        // Attention, le pseudo et le mail est-il disponible ?
                $resultat2 = $pdo -> prepare("SELECT * FROM membre WHERE email = :email");
                $resultat2 -> bindParam(':email', $_POST['email'], PDO::PARAM_STR);
                $resultat2 -> execute();

                if($resultat2 -> rowCount() > 0) {
                        $msg .= '<div class="erreur">L\'email ' . $_POST['email'] . ' n\'est pas disponible, veuillez choisir un autres email.</div>';
                }
                else{ //Ok email dispo !!


                // crypte le MDP
                $mdp = md5($_POST['mdp']); // md5() va crypté le mdp selin en hashage 64 octet

                // requete INSERT
                $resultat = $pdo -> prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, date_enregistrement, statut) VALUES(:pseudo,:mdp, :nom, :prenom, :email, :civilite, NOW(),'0')");

                $resultat -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
                $resultat -> bindParam(':mdp', $mdp, PDO::PARAM_STR);
                $resultat -> bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
                $resultat -> bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
                $resultat -> bindParam(':email', $_POST['email'], PDO::PARAM_STR);
                $resultat -> bindParam(':civilite', $_POST['civilite'], PDO::PARAM_STR);
                // redirection
                if($resultat -> execute()) { // Si la requete est OK !
                    header('location:connexion.php');
                    //$msg .= '<div class="validation">Félicitations vous êtes bien enregistré !</div>';
                }
            } // fin du else verif dipo email
        } // fin du else rowCount()
    } // Fin du if(empty($msg))
} // Fin du if(!empty($_POST)

?>



<?= $msg; ?>
<div class="container"
    <div class="row">
        <div class="col-md-5">
            <form type="#" method="post">
                <div class="form-group">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo">
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="text" class="form-control" id="mdp" name="mdp" placeholder="Entrez votre mot de passe">
                </div>
                <div class="form-group">
                    <label for="mdp">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom">
                </div>
                <div class="form-group">
                    <label for="mdp">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prenom">
                </div>
                <div class="form-group">
                    <label for="mdp">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Entrez votre email">
                </div>
                <div class="form-group">
                    <label for="mdp">Téléphone</label>
                    <input type="text" class="form-control" id="telphone" name="telephone" placeholder="Entrez votre email">
                </div>
                <div class="form-group">
                    <select class="form-control" id="civilite" name="civilite">
                        <option value="m">Homme</option>
                        <option value="f">Femme</option>
                    </select>
                </div>
            <button type="submit" class="col-md-12" class="btn btn-default">Inscription</button>
        </form>
    </div>
</div>






























<?php require('inc/footer.inc.php'); ?>
