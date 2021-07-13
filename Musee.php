<?php
require_once("connection.php");


if (isset($_REQUEST['submit'])) {

    $sql = "INSERT INTO musee(numMus,nomMus,nblivres,codePays) VALUES(:numMus,:nomMus,:nblivres,:codePays)";
    $res = $connection->prepare($sql);
    $res->execute(array(
        ":numMus" => $_POST['numMus'],
        ":nomMus" => $_POST['nomMus'],
        ":nblivres" => $_POST['nblivres'],
        ":codePays" => $_POST['codePays']
    ));
} else if (isset($_REQUEST['Update'])) {
    $sql = "UPDATE muse SET nomMus=?,nblivres=?,codePays=? WHERE numMus=? ";
    $up = $connection->prepare($sql);
    $up->execute(array(
        $_POST['nomMus'],
        $_POST['nblivres'],
        $_POST['codePays'],
        $_POST['numMus']
    ));
    $up->closeCursor();
}

if (isset($_REQUEST['supprimer'])) {
    // var_dump($_POST); verifier toutes les informations sur une variable
    $sql = "DELETE FROM muse WHERE numMus=?";
    $supp = $connection->prepare($sql);
    $supp->execute(array(
        $_POST['numMus1']
    ));
}

// affichage de musee
$sql = "SELECT * FROM musee";
$resu = $connection->prepare($sql);
$resu = $connection->query($sql);
$affichage = $resu->fetchAll(PDO::FETCH_OBJ);


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/jquery.js"></script>
</head>

<h2 class="text-center"> <u>NOTRE MUSEE</u> </h2>

<body>

    <form action="" method="post">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="w-75 p-3">

                    <div>

                        <label>Numero du musee </label>
                        <input type="text" name="numMus" id="numMus" placeholder="Ex: 10" class="form-control" autocomplete=off>
                    </div>
                    <p></p>
                    <div>
                        <label for="nbre">Nom du musee</label>
                        <input type="text" name="nomMus" id="nomMus" placeholder="Ex: Louvre" class="form-control" autocomplete=off>
                    </div>
                    <p></p>
                    <div>
                        <label for="nbre">Nombre de livres</label>
                        <input type="text" name="nblivres" id="nblivres" placeholder="Ex: 1000" class="form-control" autocomplete=off>
                    </div>
                    <p></p>
                    <div>
                        <label for="">Selectionner</label>
                        <select name="codePays" id="codePays" class="form-control">
                            <option>Selectionner un code pays</option>
                            <?php
                            //affichage de la bd de pays
                            $sql = "SELECT * FROM pays";
                            $reponsepays = $connection->prepare($sql);
                            $reponsepays = $connection->query($sql);
                            $result = $reponsepays->fetchAll(PDO::FETCH_OBJ);

                            foreach ($result as $p) : ?>

                            <option value="<?= $p->codePays  ?>"><?= $p->codePays  ?></option>


                            <?php endforeach; ?>

                        </select>
                    </div><br>

                    <div>
                        <input type="submit" name="submit" value="Enregistrer" class=" btn btn-success btn-lg">
                        <input type="submit" name="Update" value="Update" class="btn btn-warning btn-lg">
                        <input type="reset" value="Renitialiser" class="btn btn-primary btn-lg">
                    </div>

                </div>

            </div>
        </div>
    </form>


    <div class="w-100 p-3">

        <div class="table table-striped table-hover">

            <table>
                <tr>
                    <th>id</th>
                    <th> Nom du musee</th>
                    <th> Nombre de livres</th>
                    <th>Code de pays</th>
                    <th>Action</th>

                </tr>
                <?php foreach ($affichage as $aff) : ?>
                <tr>
                    <td><?= $aff->numMus  ?></td>
                    <td><?= $aff->nomMus  ?></td><br>
                    <td><?= $aff->nblivres  ?></td>
                    <td><?= $aff->codePays  ?></td>
                    <form action="" method="POST">
                        <input type="hidden" name="numMus1" value="<?php echo $aff->numMus ?>">
                        <td><input type="submit" name="supprimer" value="supprimer" class="btn btn-danger btn-ms"></td>
                    </form>


                </tr>

                <?php endforeach; ?>
            </table>

        </div>
    </div>


</body>

</html>