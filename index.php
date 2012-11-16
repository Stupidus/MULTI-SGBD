<?php
    require_once 'fonctions.php';
    require_once 'classes/connexion.class.php';
    session_start();
    
    try
    {
        $connexion = new Connexion("oracle", "grive2.u-strasbg.fr", "LPDT", "TASTYSGBD", "tastypassword", "1591");
        if(isset($_SESSION['connexion_id']) && !empty($_SESSION['connexion_id']))
        {
            $infosBdd = $connexion->query("SELECT * FROM CONNEXIONS WHERE ID = :ID", array(":ID" => $_SESSION['connexion_id']));
            if($_SESSION['id_user'] ==  $infosBdd[0]['USER_ID'] || $_SESSION['adminlevel'] > 0)
                $connexion_bdd = new Connexion($infosBdd[0]['SGBD'], $infosBdd[0]['HOST'], $infosBdd[0]['DBNAME'], $infosBdd[0]['USERNAME'], $infosBdd[0]['PASSWORD'], $infosBdd[0]['PORT']);
            else die("LOLNOPE");
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
    
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
                case 4:
                    $content = get_include_contents('users.php');
                    break;
                case 5:
                    $content = get_include_contents('dico.php');
                    break;
                case 6:
                    $content = get_include_contents('crea_tables.php');
                    break;
                case 7:
                    $content = get_include_contents('backup.php');
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
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <title>MULTI-SGBD</title>
    </head>
    <body>
        <h1><a href=".">MULTI-SGBD</a></h1>
        <?php echo $content; ?>
        <br/>
        <br/>
        <?php
        if(isset($_SESSION['connexion_id']) && !empty($_SESSION['connexion_id']))
        {
            echo "<a href='?cat=0'>Gestion des bases de données</a> - ";
        }
        ?>
        <a href="?cat=3">Se déconnecter</a>
    </body>
</html>
