<?php
require_once("connection.php");

if (isset($_REQUEST['submit'])) {
    if (empty($_POST['code']) or empty($_POST['nbre'])) {
        echo "Erreur: tous les champs n'ont pas ete renseigner!!!";
    } else {
        $sql = "INSERT INTO pays(codePays,nbhabitant) VALUES(:codePays,:nbhabitant)";

        $res = $connection->prepare($sql);
        $res->execute(array(
            ":codePays" => $_POST['code'],
            ":nbhabitant" => $_POST['nbre']
        ));
    }
} else if (isset($_REQUEST["supprimer"])) {
    $sql = "DELETE FROM pays WHERE codePays=?";
    $sup = $connection->prepare($sql);
    $sup->execute(array(
        $_POST['codePays2']
    ));
}
if (isset($_REQUEST["Update"])) {
    $sql = "UPDATE pays SET nbhabitant=?  WHERE codePays=?  ";
    $sup = $connection->prepare($sql);
    $sup->execute(array(
        $_POST['nbre'],
        $_POST['code']
    ));
}


//affichage de la bd de pays
$sql = "SELECT * FROM pays";
$reponsepays = $connection->prepare($sql);
$reponsepays = $connection->query($sql);
$result = $reponsepays->fetchAll(PDO::FETCH_OBJ);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/jquery.js"></script>
</head><br>

<h2 class="text-center"><u>LES PAYS</u> </h2>


<form action="" method="post">

    <div class="container-fluide">
        <div class="d-flex justify-content-center">
            <div class="w-75 p-3">
                <div>
                    <label for="code">Code Pays :</label>
                    <input type="text" name="code" id="code" placeholder="Code a inserer ou modifier" class="form-control">
                </div>
                <br>
                <div>
                    <label for="nbre">Nombre d'Habitants :</label>
                    <input type="text" name="nbre" id="nbre" placeholder="Ex: 1000" class="form-control">
                </div>
                <br>
                <div>
                    <input type="submit" name="submit" value="Enregistrer" class=" btn btn-success btn-lg">
                    <input type="submit" name="Update" value="Update" class="btn btn-warning btn-lg">
                    <input type="reset" value="Renitialiser" class="btn btn-primary btn-lg">
                </div>
            </div>
        </div>

        <div class="dep">
            <div class="w-75 p-3 justify-content-center">

                <div class="table table-striped table-hover">

                    <table>
                        <tr>
                            <th> Code de pays</th>
                            <th> Nombre d'Habitants</th>
                            <th>Actions</th>
                        </tr>
                        <?php foreach ($result as $p) : ?>
                            <tr>
                                <td><?= $p->codePays  ?></td><br>
                                <td><?= $p->nbhabitant  ?></td>

                                <form action="" method="POST">
                                    <input type="hidden" name="codePays2" value="<?php echo $p->codePays ?>">
                                    <td><input type="submit" name="supprimer" value="supprimer" class="btn btn-danger btn-ms"></td>
                                </form>

                            </tr>

                        <?php endforeach; ?>

                    </table>
                </div>
            </div>
        </div>

    </div>
</form>



</html>