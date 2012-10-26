<h3>Gestion de la base de données</h3>
<?php
if(isset($_SESSION['connexion']['valide']) && !empty($_SESSION['connexion']['valide']) && $_SESSION['connexion']['valide'])
{
    $connexion = $_SESSION['connexion'];
    try 
    {
        $connexion = new Connexion($connexion['vars']['SGBD'], $connexion['vars']['host'], $connexion['vars']['dbname'], $connexion['vars']['username'], $connexion['vars']['password'], $connexion['vars']['port']);
    }
    catch(Exception $e)
    {
        echo "Erreur lors de la connexion à la base";
    }
}
else
    echo "Vous n'êtes connecté à aucune base de données. <a href='index.php'></a>";
?>