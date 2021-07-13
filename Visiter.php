<!-- Visiter[numMus#, jour#, nbvisiteurs] -->

<?php
require_once('connection.php');


if (isset($_REQUEST['submit'])) {
    if (empty($_POST['numMus']) or empty($_POST['jour']) or empty($_POST['visiteurs'])) {
        echo "Erreur: tous les champs n'ont pas ete renseigner!!!";
    } else {
        $sql = "INSERT INTO visiter(numMus,jour,nbvisiteurs) VALUES (:numMus,:jour,:nbvisiteurs)";
        $insertion_visiter = $connection->prepare($sql);
        $insertion_visiter->closeCursor();
        $insertion_visiter->execute(array(
            ':numMus' => $_POST['numMus'],
            ':jour' => $_POST['jour'],
            ':nbvisiteurs' => $_POST['visiteurs']
        ));
    }
} else if (isset($_REQUEST['Update'])) {
    $sql = "UPDATE visiter SET jour=? ,nbvisiteurs=? WHERE numMus=? ";
    $update_visiter = $connection->prepare($sql);
    $update_visiter->execute(array(
        $_POST['jour'],
        $_POST['visiteurs'],
        $_POST['numMus']
    ));
}

if (isset($_REQUEST['supprimer'])) {
    $Sql = "DELETE FROM visiter WHERE numMus=?";
    $supprimer_visiter = $connection->prepare($Sql);
    $supprimer_visiter->execute(array($_POST['numMus1']));
}

// affichage de la db
$sql = "SELECT * FROM visiter ";
$affichage_visiter = $connection->prepare($sql);
$affichage_visiter = $connection->query($sql);
$resultat_visiter =   $affichage_visiter->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/jquery.js"></script>
</head><br>

<h2 class="text-center"><u>VISITE</u> </h2>

<form action="" method="post">

    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="w-75 p-3">

                <div>
                    <label for="">Selectionner votre numero musee :</label>
                    <select name="numMus" class="form-control">

                        <option>Numero Musee a inserer ou update</option>
                        <?php
                        //affichage de la db de pays
                        $sql = "SELECT * FROM muse";
                        $affichage_pays = $connection->prepare($sql);
                        $affichage_pays = $connection->query($sql);
                        $resultat_pays = $affichage_pays->fetchAll(PDO::FETCH_OBJ);

                        foreach ($resultat_pays as $table_pays) : ?>
                        <option value="<?= $table_pays->numMus ?>"><?= $table_pays->numMus ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <p></p>
                <div>
                    <label for="">Selectionner votre IBSN :</label>
                    <select name="jour" class="form-control">
                        <option>Selectionner le jour</option>
                        <?php
                        //affichage de la db de pays
                        $sql = 'SELECT * FROM moment';
                        $affichage_moment = $connection->prepare($sql);
                        $affichage_moment = $connection->query($sql);
                        $resultat_moment = $affichage_moment->fetchAll(PDO::FETCH_OBJ);

                        foreach ($resultat_moment as $table_moment) : ?>

                        <option value="<?= $table_moment->jour ?>"><?= $table_moment->jour ?></option>


                        <?php endforeach; ?>
                    </select>
                </div>
                <p></p>
                <div>
                    <label for="nbre">Visiteurs :</label>
                    <input type="text" name="visiteurs" id="visiteurs" class="form-control">
                </div>
                <p></p>
                <p></p>
                <div>
                    <input type="submit" name="submit" value="Enregistrer" class=" btn btn-success btn-lg">
                    <input type="submit" name="Update" value="Update" class="btn btn-warning btn-lg">
                    <input type="reset" value="Renitialiser" class="btn btn-primary btn-lg">
                </div>
</form>


<div class="dep">
    <div class="w-100 p-3">
        <p><br></p>
        <div class="table table-striped table-hover">

            <table class="table">
                <tr>
                    <th>Numero du musee</th>
                    <th>Jour</th>
                    <th>Visiteurs</th>
                    <th>Actions</th>
                </tr>

                <?php foreach ($resultat_visiter  as   $table_visiter) : ?>
                <tr>
                    <td><?= $table_visiter->numMus ?></td>
                    <td><?= $table_visiter->jour ?></td>
                    <td><?= $table_visiter->nbvisiteurs ?></td>

                    <form action="" method="POST">
                        <input type="hidden" name="numMus1" value="<?php echo   $table_visiter->numMus ?>">
                        <td><input type="submit" name="supprimer" value="supprimer" class="btn btn-danger btn-ms"></td>
                    </form>
                </tr>
                <?php endforeach; ?>

            </table>

        </div>
    </div>


</div>

</html>