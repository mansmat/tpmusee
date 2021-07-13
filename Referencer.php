<!-- Referencer[nomSite#, numeroPage, ISBN#] -->
<?php
require_once('connection.php');

if (isset($_REQUEST['submit'])) {
    if (empty($_POST['nom']) or empty($_POST['page']) or empty($_POST['ISBN'])) {
    } else {
        $sql = "INSERT INTO referencer(nomSite,numeroPage,ISBN) VALUES (:nomSite,:numeroPage,:ISBN)  ";
        $insert = $connection->prepare($sql);
        $insert->closeCursor();
        $insert->execute(array(
            ':nomSite' => $_POST['nom'],
            ':numeroPage' => $_POST['page'],
            ':ISBN' => $_POST['ISBN']

        ));
    }
} else if (isset($_REQUEST['Update'])) {
    $sql = "UPDATE referencer SET numeroPage=?,ISBN=? WHERE nomSite=? ";
    $up = $connection->prepare($sql);
    $up->execute(array(
        $_POST['page'],
        $_POST['ISBN'],
        $_POST['nom']
    ));
}

if (isset($_REQUEST['supprimer'])) {
    $Sql = "DELETE FROM referencer WHERE nomSite=?";
    $eff = $connection->prepare($Sql);
    $eff->execute(array($_POST['nomSite1']));
}





// affichage de la db
$sql = "SELECT * FROM referencer ";
$rep = $connection->prepare($sql);
$rep = $connection->query($sql);
$resulta = $rep->fetchAll(PDO::FETCH_OBJ);


?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/jquery.js"></script>
</head><br>

<h2 class="text-center"> <u>REFERENCER</u> </h2>


<form action="" method="post">

    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="w-75 p-3">

                <div>
                    <label for="">Selectionner le nom :</label>
                    <select name="nom" class="form-control">
                        <option>Selectionner le nom de votre site</option>
                        <?php
                        //affichage de la bd de pays
                        $sql = "SELECT * FROM site";
                        $rep = $connection->prepare($sql);
                        $rep = $connection->query($sql);
                        $resultat = $rep->fetchAll(PDO::FETCH_OBJ);


                        foreach ($resultat as $affich) : ?>

                        <option value="<?= $affich->nomSite ?>"><?= $affich->nomSite ?></option>


                        <?php endforeach; ?>
                    </select>

                </div>
                <p></p>
                <div>
                    <label for="nbre">Numero de Page</label>
                    <input type="text" name="page" id="page" class="form-control">
                </div>
                <p></p>
                <div>
                    <label for="">Selectionner votre IBSN :</label>
                    <select name="ISBN" class="form-control">
                        <option>Selectionner votre ISBN</option>
                        <?php
                        //affichage de la bd de pays
                        $sql = 'SELECT * FROM Ouvrage';
                        $result = $connection->prepare($sql);
                        $result = $connection->query($sql);
                        $affichage = $result->fetchAll(PDO::FETCH_OBJ);

                        foreach ($affichage as $ouvr) : ?>

                        <option value="<?= $ouvr->ISBN ?>"><?= $ouvr->ISBN ?></option>


                        <?php endforeach; ?>
                    </select>

                </div>
                <p><br></p>
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

            <table>
                <tr>
                    <th>Nom du site</th>
                    <th>Numero de page</th>
                    <th>ISBN</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($resulta as $ref) : ?>
                <tr>
                    <td><?= $ref->nomSite ?></td>
                    <td><?= $ref->numeroPage ?></td>
                    <td><?= $ref->ISBN ?></td>

                    <form action="" method="POST">
                        <input type="hidden" name="nomSite1" value="<?php echo $ref->nomSite ?>">
                        <td><input type="submit" name="supprimer" value="supprimer" class="btn btn-danger btn-ms"></td>
                    </form>


                </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</div>

</html>