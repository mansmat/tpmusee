<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/pays1.css">
    <script src="bootstrap/js/jquery.js"></script>
</head>


<div class="navbar navbar-expand-md bg-dark navbar-dark d-flex justify-content-center">
    <nav class="text-center">
        <li style="display: inline-flex; margin: 20px; font-size:25px;">
            <ol><a href="index.php?choice=2">PAYS</a></ol>
            <ol><a href="index.php?choice=3">MUSEE</a></ol>
            <ol><a href="index.php?choice=4">OUVRAGE</a></ol>
            <ol><a href="index.php?choice=5">VISITER</a></ol>
            <ol><a href="index.php?choice=6">BIBLIOTHEQUE</a></ol>
            <ol><a href="index.php?choice=7">SITE</a></ol>
            <ol><a href="index.php?choice=8">REFERENCER</a></ol>
        </li>
    </nav>
</div>
<h1 class="text-center">G@udeSoft & RodriIT MUSUEM</h1>


<body>
    <div class="d-flex justify-content-center">
        <div class=" w-50 p-3">
            <div class="sp">
                <?php


				if (isset($_REQUEST['choice'])) {
					switch ($_REQUEST['choice']) {

						case '2':
							include('Pays.php');
							break;

						case '3':
							include('Musee.php');
							break;

						case '4':
							include('Ouvrage.php');
							break;

						case '5':
							include('Visiter.php');
							break;

						case '6':
							include('Bibliotheque.php');
							break;
						case '7':
							include('Site.php');
							break;
						case '8':
							include('Referencer.php');
							break;

						default:
							include('acceuil.php');
					}
				}

				?>

            </div>
        </div>
    </div>
</body>

<footer>
    <p><br><br></p>
</footer>

</html>