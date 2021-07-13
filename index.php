<!DOCTYPE html>
<html>
  <head>
        <title>MUSEE</title>
   <meta charset="utf-8">  
<link href="Css/base.css" media="screen" rel="stylesheet" type="text/css">
<link href="Css/styles.css" media="screen" rel="stylesheet" type="text/css">
<link href="Css/typo-futura.css" media="screen" rel="stylesheet" type="text/css">
<link href="Css/header-standard.css" media="screen" rel="stylesheet" type="text/css">
<link href="Css/carousel.css" media="screen" rel="stylesheet" type="text/css">
<link href="Css/home.css" media="screen" rel="stylesheet" type="text/css">  
<link rel="stylesheet" href="bootstrap/css/pays.css"> 
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> 
</head>
  <body>
        <div id="header">
                <div class="inner"><br/>
                        <img src="Images/Benin1.PNG" alt="Benin" width="150" height="100">
                        <div id="nav-primary"  >
                                <ul class="navigation">
                                        <li class=""><a href="index.php?choice=2">PAYS</a></li>
                                        <li class=""><a href="index.php?choice=3">MUSEE</a></li>
                                        <li class=""><a href="index.php?choice=4">OUVRAGE</a></li>
                                        <li class=""><a href="index.php?choice=5">VISITER</a></li>
                                        <li class=""><a href="index.php?choice=6">BIBLIOTHEQUE</a></li>
                                        <li class=""><a href="index.php?choice=7">SITE</a></li>
                                        <li class=""><a href="index.php?choice=8">REFERENCER</a></li>
                                </ul>
                        </div>
                </div>
        </div>
        <h1 class="text-center" style="text-align: center; font-family:Ar esence Moyen ,verdana,impact ; font-size: 50px">G@udeSoft & RodriIT MUSUEM</h1>


        <div class="d-flex justify-content-center" >
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
<h2 align="center" style="font-family: segoe script; font-weight: bold;">MUSUEM-Group 2021</h2>
</body>
</html>