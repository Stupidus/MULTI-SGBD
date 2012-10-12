<h3>Gestion de la base de données</h3>
<?php
if(isset($_SESSION['connexion']) && !empty($_SESSION['connexion']))
{
    $connexion = unserialize($_SESSION['connexion']);
}
else
    echo "Vous n'êtes connecté à aucune base de données. <a href='index.php'></a>";
?>
