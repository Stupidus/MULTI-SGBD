<?php
global $connexion_bdd;

echo "<a href='".$_SERVER['HTTP_REFERER']."'>Retour</a><br/><br/>";

if(isset($_GET['m']) && !empty($_GET['m']))
    $m = $_GET['m'];
else
    $m = null;    
switch($m)
{
    case 1:
        break;
    default:
        break;
}
?>