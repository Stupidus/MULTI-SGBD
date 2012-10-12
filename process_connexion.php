<?php
try {
    echo "<h3>Connexion en cours</h3>";
    $connexion = new Connexion($_POST['sgbd'], $_POST['host'], $_POST['dbname'], $_POST['username'], $_POST['password'], $_POST['port']);
    $_SESSION['connexion'] = serialize($connexion);
    echo "Vous êtes bien connecté à la base de données : <a href='?cat=2'>Continuer</a>";
}
catch(Exception $e)
{
    echo $e->getMessage();
}
?>
