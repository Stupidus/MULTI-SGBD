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
    case 3:
        $args = array(
            "ID" => $_POST['id'],
            "USERNAME" => $_POST['username'],
            "PASSWORD" => $_POST['password'],
            "ADMINLEVEL" => $_POST['adminlevel']
        );
        $connexion->query("UPDATE USERS SET USERNAME = :USERNAME, PASSWORD = :PASSWORD, ADMINLEVEL = :ADMINLEVEL WHERE ID = :ID", $args);
        echo "L'utilisateur a bien été modifié. <a href='?cat=0'>Gestion des bases de données</a>";
        break;
    default:
        $infos = $connexion->query("SELECT * FROM USERS WHERE ID = :ID", array(":ID" => $_GET['user_id']));
        ?>
        <div class="center">
            <br/>
            <fieldset>
                <h3>Modifier un utilisateur</h3>
                <form action="?cat=4&amp;m=3" method="POST">            
                        <label for="username">Utilisateur : </label>
                        <input type="text" name="username" id="username" value="<?php echo $infos[0]['USERNAME']; ?>"/>
                        <br/>
                        <label for="password">Mot de passe : </label>
                        <input type="password" name="password" id="password" value="<?php echo $infos[0]['PASSWORD']; ?>"/>
                        <br/>
                        <label for="adminlevel">Admin Level (0/1) : </label>
                        <input type="text" name="adminlevel" id="adminlevel" value="<?php echo $infos[0]['ADMINLEVEL']; ?>"/>
                        <br/>
                        <br/>
                        <input type="hidden" name="id" value="<?php echo $infos[0]['ID']; ?>"/>
                        <div id="centerbutton">
                            <input type="submit" value="Modifier"/>
                        </div>
                </form>
            </fieldset>
        </div>
        <?php
        break;
}
?>
