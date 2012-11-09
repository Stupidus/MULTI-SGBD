<?php
    require_once 'fonctions.php';
    require_once 'classes/connexion.class.php';
    session_start();
    
    if(isset($_GET['cat']) && !empty($_GET['cat']))
        $cat = $_GET['cat'];
    else
        $cat = null;    
    if(isset($_SESSION['auth']) && !empty($_SESSION['auth']))
    {
        if($_SESSION['auth'])
        {
            switch($cat)
            {     
                case 1:
                    $content = get_include_contents('process_connexion.php');
                    break;
                case 2:
                    $content = get_include_contents('gestion.php');
                    break;
                case 3:
                    session_destroy();
                    $content = "La session été fermée. <a href='index.php'>Retour</a>";
                    break;
                default:
                        $content = get_include_contents('defaut.php');
                    break;
            }
        }
    }
    else
    {
        $content = get_include_contents('connexion_appli.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" media="all" href="styles.css" />
        <title>MULTI-SGBD</title>
    </head>
    <body>
        <h1><a href=".">MULTI-SGBD</a></h1>
        <?php echo $content; ?>
        <br/>
        <br/>
        <a href="?cat=3">Se déconnecter</a>
    </body>
</html>
