<?php
global $connexion;

if(isset($_GET['m']) && !empty($_GET['m']))
    $m = $_GET['m'];
else
    $m = null;    
switch($m)
{
    case 1:
        $infos = $connexion->query("SELECT MAX(ID) FROM CONNEXIONS");
        $id = (int) $infos[0]['MAX(ID)'];
        $args = array(
            "ID" => $id + 1,
            "LABEL" => $_POST['label'],
            "SGBD" => $_POST['sgbd'],
            "HOST" => $_POST['host'],
            "PORT" => $_POST['port'],
            "DBNAME" => $_POST['dbname'],
            "USERNAME" => $_POST['username'],
            "PASSWORD" => $_POST['password'],
            "USER_ID" => $_SESSION['id_user']
        );
        $connexion->query("INSERT INTO CONNEXIONS (ID, LABEL, SGBD, HOST, PORT, DBNAME, USERNAME, PASSWORD, USER_ID) VALUES (:ID, :LABEL, :SGBD, :HOST, :PORT, :DBNAME, :USERNAME, :PASSWORD, :USER_ID)", $args);
        echo "La connexion a bien été ajoutée. <a href='?cat=0'>Gestion des bases de données</a>";
        break;
    default:
        $listeConnexions = $connexion->query("SELECT * FROM CONNEXIONS WHERE ID = :ID", array(":ID" => $_GET['connexion_id']));
        try {
            $connexionTest = new Connexion($listeConnexions[0]['SGBD'], $listeConnexions[0]['HOST'], $listeConnexions[0]['DBNAME'], $listeConnexions[0]['USERNAME'], $listeConnexions[0]['PASSWORD'], $listeConnexions[0]['PORT']);
            $_SESSION['connexion_id'] = $_GET['connexion_id'];
            echo "La connexion ".$listeConnexions[0]['LABEL']." a bien été selectionnée. <a href='?cat=2'>Retour</a>";
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        break;
}
?>
