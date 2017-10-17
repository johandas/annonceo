<?php require('inc/init.inc.php'); ?>
<?php require('inc/header.inc.php');?>
<?php


if(!userConnect()) {
    header('location:connexion.php');
}



  extract($_SESSION['membre']);

?>









  <!-- Contenu HTML -->

  <h1>Profil de <?= $pseudo ?></h1>






  <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title"><?= $pseudo ?></h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class=" col-md-9 col-lg-9 ">
                    <table class="table table-user-information">
                      <tbody>
                        <tr>
                          <td>Nom:</td>
                          <td><?= $nom ?></td>
                        </tr>
                        <tr>
                          <td>Prénom :</td>
                          <td><?= $prenom ?></td>
                        </tr>
                        <tr>
                          <td>Pseudo :</td>
                          <td><?= $pseudo ?></td>
                        </tr>
                        <tr>
                          <td>Téléphone :</td>
                          <td><?= $telephone ?></td>
                        </tr>
                        <tr>
                          <td>Email :</td>
                          <td><?= $email ?></td>
                        </tr>
                        <tr>
                          <td>Membre depuis le :</td>
                          <td><?= $date_enregistrement ?></td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
                   <div class="panel-footer">
                          <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                          <span class="pull-right">
                              <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                              <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                          </span>
                      </div>

            </div>
          </div>
        </div>
  </div>





















<?php require('inc/footer.inc.php');?>
