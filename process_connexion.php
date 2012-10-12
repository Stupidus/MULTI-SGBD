<?php
try {
    $connexion = new Connexion($_POST['sgbd'], $_POST['host'], $_POST['dbname'], $_POST['username'], $_POST['password'], $_POST['port']);
}
catch(Exception $e)
{
    echo $e->getMessage();
}
?>
