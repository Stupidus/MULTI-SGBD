<?php
include 'classes/connexion.class.php';
$connexion = new Connexion("mysql", "localhost", "2012_vantoine", "2012_vantoine", "jpkc5k6t");
$array = $connexion->query("SELECT * FROM test");
print_r($array);
?>
