<?php
require_once("connection.php");

if (isset($_REQUEST['submit'])) {
    if (empty($_POST['ISBN']) or empty($_POST['nbPage']) or empty($_POST['titre']) or empty($_POST['codePays'])) {
        echo "Erreur: tous les champs n'ont pas ete renseigner!!!";
    } else {
        $sql = "INSERT INTO ouvrage(ISBN,nbPage,titre,codePays) VALUES (:ISBN,:nbPage,:titre,:codePays)  ";
        $insert = $connection->prepare($sql);
        $insert->execute(array(
            ':ISBN' => $_POST['ISBN'],
            ':nbPage' => $_POST['nbPage'],
            ':titre' => $_POST['titre'],
            ':codePays' => $_POST['codePays']

        ));
    }
} else if (isset($_REQUEST['Update'])) {
    $sql = "UPDATE ouvrage SET nbPage=?,titre=?,codePays=? WHERE ISBN=? ";
    $up = $connection->prepare($sql);
    $up->execute(array(

        $_POST['nbPage'],
        $_POST['titre'],
        $_POST['codePays'],
        $_POST['ISBN']

    ));
}


if (isset($_REQUEST['supprimer'])) {
    $sql = "DELETE FROM ouvrage WHERE ISBN=?";
    $suppression = $connection->prepare($sql);
    $suppression->execute(array($_POST['ISBN1']));
}

// affichagede ouvrage

$sql = 'SELECT * FROM Ouvrage';
$result = $connection->prepare($sql);
$result = $connection->query($sql);
$affichage = $result->fetchAll(PDO::FETCH_OBJ);

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/biblio.css">
    <script src="bootstrap/js/jquery.js"></script>

</head>

<h2 class="text-center"><u>NOS OUVRAGES</u></h2>




<form action="" method="post">

    <div class="container ">
        <div class="d-flex justify-content-center">
            <div class="w-75 p-3">

                <div>
                    <label for="nbre">ISBN :</label>
                    <input type="text" name="ISBN" id="ISBN" class="form-control" autocomplete=off>
                </div>
                <p></p>
                <div>
                    <label for="nbre">Nombre de pages :</label>
                    <input type="text" name="nbPage" id="nbpage" placeholder="Ex: 1000" class="form-control" autocomplete=off>
                </div>
                <p></p>
                <div>
                    <label for="nbre">Titre de l'ouvrage :</label>
                    <input type="text" name="titre" id="titre" placeholder="Zadig" class="form-control" autocomplete=off>
                </div>
                <p></p>
                <div>
                    <label for="">Selectionner :</label>
                    <select name="codePays" id="codePays" class="form-control">
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
                <p></p>
                <div>
                    <input type="submit" name="submit" value="Enregistrer" class="btn btn-success btn-lg">
                    <input type="submit" name="Update" value="Update" class="btn btn-warning btn-lg">
                    <input type="reset" value="Renitialiser" class="btn btn-primary btn-lg">

                </div>
            </div>
        </div>
</form>


</div>

<div class="dep">
    <div class="w-100 p-3">
        <p><br></p>
        <div class="table table-striped table-hover">
            <table>
                <tr>
                    <th>ISBN</th>
                    <th>Nombre de pages</th>
                    <th>Titre de l'ouvrage</th>
                    <th>code du pays</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($affichage as $ouvr) : ?>
                <tr>
                    <td><?= $ouvr->ISBN ?></td>
                    <td><?= $ouvr->nbPage ?></td>
                    <td><?= $ouvr->titre ?></td>
                    <td><?= $ouvr->codePays ?></td>


                    <form action="" method="POST">
                        <input type="hidden" name="ISBN1" value="<?php echo $ouvr->ISBN ?>">
                        <td><input type="submit" name="supprimer" value="supprimer" class="btn btn-danger btn-ms"></td>
                    </form>


                </tr>
                <?php endforeach; ?>
            </table>

        </div>
        <p><br><br></p>

    </div>
</div>

</html>