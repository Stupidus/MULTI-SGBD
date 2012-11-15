<?php
global $connexion;

if(isset($_GET['m']) && !empty($_GET['m']))
    $m = $_GET['m'];
else
    $m = null;    
switch($m)
{
    case 1:
        $infos = $connexion->query("SELECT MAX(ID) FROM USERS");
        $id = (int) $infos[0]['MAX(ID)'];
        $args = array(
            "ID" => $id + 1,
            "USERNAME" => $_POST['username'],
            "PASSWORD" => $_POST['password'],
            "ADMINLEVEL" => 0
        );
        $connexion->query("INSERT INTO USERS (ID, USERNAME, PASSWORD, ADMINLEVEL) VALUES (:ID, :USERNAME, :PASSWORD, :ADMINLEVEL)", $args);
        echo "L'utilisateur a bien été ajouté. <a href='?cat=0'>Gestion des bases de données</a>";
        break;
    case 2:
        $connexion->query("DELETE FROM USERS WHERE ID = :ID", array(":ID" => $_GET['user_id']));
        echo "L'utilisateur a bien été supprimé. <a href='?cat=0'>Gestion des bases de données</a>";
        break;
    default:        
        break;
}
?>
