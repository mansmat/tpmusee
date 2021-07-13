<!-- Bibliothèque[numMus#, ISBN#, dateAchat] -->
<?php
require_once("connection.php");

if (isset($_REQUEST['submit'])) {
    if (empty($_POST['numMus']) or empty($_POST['ISBN']) or empty($_POST['dateAchat'])) {
        echo "Erreur: tous les champs n'ont pas ete renseigner!!!";
    } else {
        if (isset($_POST['dateAchat'])) {
            $date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['dateAchat'])));
        }
        $sql = "INSERT INTO Bibliotheque(numMus,ISBN,dateAchat) VALUES(:numMus,:ISBN,:dateAchat )";
        $res = $connection->prepare($sql);
        $res->execute(array(
            ":numMus" => $_POST['numMus'],
            ":ISBN" => $_POST['ISBN'],
            ":dateAchat" => $date
        ));
    }
} else if (isset($_REQUEST['Update'])) {
    $sql = "UPDATE Bibliotheque SET ISBN=?,dateAchat=? WHERE numMus=? ";
    $up = $connection->prepare($sql);
    $up->execute(array(

        $_POST['ISBN'],
        $_POST['dateAchat'],
        $_POST['numMus']
    ));
    $up->closeCursor();
}




if (isset($_REQUEST["supprimer"])) {
    $sql = "DELETE FROM Bibliotheque WHERE numMus=?";
    $sup = $connection->prepare($sql);
    $sup->execute(array(
        $_POST['numMuse']
    ));
}


// affichage de bibliotheque
$sql = "SELECT * FROM bibliotheque";
$affi = $connection->prepare($sql);
$affi = $connection->query($sql);
$affichag = $affi->fetchAll(PDO::FETCH_OBJ);


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/jquery.js"></script>
</head><br>

<h2 class="text-center"> <u>NOTRE BIBLIOTHEQUE</u> </h2>

<form action="" method="post">

    <div class="container ">
        <div class="d-flex justify-content-center">
            <div class="w-75 p-3">

                <div>
                    <label for="">Selectionner votre numero musee :</label>
                    <select name="numMus" class="form-control">
                        <option>Numero Musee a inserer ou update</option>
                        <?php
                        //affichage de la bd de pays
                        $sql = "SELECT * FROM muse";
                        $resu = $connection->prepare($sql);
                        $resu = $connection->query($sql);
                        $affichage = $resu->fetchAll(PDO::FETCH_OBJ);

                        foreach ($affichage as $aff) : ?>

                        <option value="<?= $aff->numMus ?>"><?= $aff->numMus ?></option>

                        <?php endforeach; ?>
                    </select>

                </div>
                <p></p>
                <div>
                    <label for="">Selectionner votre IBSN :</label>
                    <select name="ISBN" class="form-control">
                        <option>Selectionner votre ISBN </option>
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
                    <p></p>
                    <div>
                        <label for="nbre">Date d'achat :</label>
                        <input type="date" name="dateAchat" min=1960-01-01 class="form-control">
                    </div>

                </div>

                <br>
                <div>
                    <input type="submit" name="submit" value="Enregistrer" class=" btn btn-success btn-lg">
                    <input type="submit" name="Update" value="Update" class="btn btn-warning btn-lg">
                    <input type="reset" value="Renitialiser" class="btn btn-primary btn-lg">

                </div>
            </div>
        </div>


        <div class="mx-auto">
            <div class="w-100 p-3">
                <div class="table table-striped table-hover">
                    <blockquote>
                        <table>

                            <tr>
                                <th>numero du musee</th>
                                <th> ISBN</th>
                                <th> date d'achat</th>
                                <th>Actions</th>
                            </tr>
                            <?php foreach ($affichag as $p) : ?>

                            <tr>
                                <td><?= $p->numMus  ?></td><br>
                                <td><?= $p->ISBN ?></td>
                                <td><?= $p->dateAchat ?></td>
                                <form action="" method="POST">
                                    <input type="hidden" name="numMuse" value="<?php echo $p->numMus ?>">
                                    <td><input type="submit" name="supprimer" value="supprimer" class="btn btn-danger btn-ms"></td>
                                </form>

                            </tr>
                            <?php endforeach; ?>

                        </table>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>

</form>





</html>