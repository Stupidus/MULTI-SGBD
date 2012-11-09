<?php
global $connexion;

if(isset($_GET['m']) && !empty($_GET['m']))
    $m = $_GET['m'];
else
    $m = null;    
switch($m)
{
    default:
        $listeConnexions = $connexion->query("SELECT * FROM CONNEXIONS WHERE ID = :ID", array(":ID" => $_GET['id_connexion']));
        try {
            $connexionTest = new Connexion($listeConnexions[0]['SGBD'], $listeConnexions[0]['HOST'], $listeConnexions[0]['PORT'], $listeConnexions[0]['DBNAME'], $listeConnexions[0]['USERNAME'], $listeConnexions[0]['PASSWORD']);
            $_SESSION['id_connexion'] = $_GET['id_connexion'];
            echo "La connexion ".$listeConnexions[0]['LABEL']." a bien été selectionnée. <a href='?cat=2'>Retour</a>";
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        break;
}
?>
