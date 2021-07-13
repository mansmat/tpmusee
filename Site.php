<!-- Site[nomSite, anneedecouv, codePays#] -->
<?php
require_once("connection.php");

if (isset($_REQUEST['submit'])) {
    if (empty($_POST['nom']) or empty($_POST['annee']) or empty($_POST['codePays'])) {
        echo "Erreur: tous les champs n'ont pas ete renseigner!!!";
    } else {
        $sql = "INSERT INTO site(nomSite,anneedecouv,codePays) VALUES (:nomSite,:anneedecouv,:codePays)  ";
        $insert = $connection->prepare($sql);
        $insert->closeCursor();
        $insert->execute(array(
            ':nomSite' => $_POST['nom'],
            ':anneedecouv' => $_POST['annee'],
            ':codePays' => $_POST['codePays']

        ));
    }
} else if (isset($_REQUEST['Update'])) {
    $sql = "UPDATE site SET anneedecouv=?,codePays=? WHERE nomSite=? ";
    $up = $connection->prepare($sql);
    $up->execute(array(


        $_POST['annee'],
        $_POST['codePays'],
        $_POST['nom']
    ));
}

if (isset($_REQUEST['supprimer'])) {
    $Sql = "DELETE FROM site WHERE nomSite=?";
    $eff = $connection->prepare($Sql);
    $eff->execute(array($_POST['nomSite1']));
}




// affichage de la db
$sql = "SELECT * FROM site";
$rep = $connection->prepare($sql);
$rep = $connection->query($sql);
$resultat = $rep->fetchAll(PDO::FETCH_OBJ);



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/jquery.js"></script>
</head><br>

<h1 class="text-center"><u>SITE</u> </h1>


<form action="" method="post">


    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="w-75 p-3">

                <br>
                <div>
                    <label for="nbre">Nom du site :</label>
                    <input type="text" name="nom" autocomplete=off class="form-control">
                </div>
                <p></p>
                <div>
                    <label for="nbre">Annee de decouverte :</label>
                    <input type="text" name="annee" autocomplete=off class="form-control">
                </div>
                <p></p>
                <div>
                    <label for="">Selectionner votre code pays :</label>
                    <select name="codePays" class="form-control">
                        <option>Selectionner un code pays</option>
                        <?php
                        //affichage de la bd de pays
                        $sql = "SELECT * FROM pays";
                        $rep = $connection->prepare($sql);
                        $rep = $connection->query($sql);
                        $result = $rep->fetchAll(PDO::FETCH_OBJ);

                        foreach ($result as $p) : ?>

                        <option value="<?= $p->codePays  ?>"><?= $p->codePays  ?></option>


                        <?php endforeach; ?>
                    </select>

                </div>
                <p><br></p>
                <div>
                    <input type="submit" name="submit" value="Enregistrer" class=" btn btn-success btn-lg">
                    <input type="submit" name="Update" value="Update" class="btn btn-warning btn-lg">
                    <input type="reset" value="Renitialiser" class="btn btn-primary btn-lg">

                </div>

            </div>
        </div>


        <div class="w-100 p-3">
            <p><br></p>
            <div class="table table-striped table-hover">
                <table>
                    <tr>
                        <th>Nom du site</th>
                        <th>Annee de decouverte</th>
                        <th>code du pays</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($resultat as $affich) : ?>
                    <tr>
                        <td><?= $affich->nomSite ?></td>
                        <td><?= $affich->anneedecouv ?></td>
                        <td><?= $affich->codePays ?></td>

                        <form action="" method="POST">
                            <input type="hidden" name="nomSite1" value="<?php echo $affich->nomSite ?>">
                            <td><input type="submit" name="supprimer" value="supprimer" class="btn btn-danger btn-ms"></td>
                        </form>


                    </tr>
                    <?php endforeach; ?>


                </table>

            </div>
        </div>



    </div>

</html>