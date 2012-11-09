<h3>Connexion</h3>
<?php
    if(isset($_GET['m']) && $_GET['m'] == "1")        
    {
        $q = $connexion->query("SELECT * FROM USERS WHERE USERNAME = :username AND PASSWORD = :password", array(":username" => $_POST['username'], ":password" => $_POST['password']));

        if(sizeof($q) > 0)
        {
            $_SESSION['auth'] = true;
            $_SESSION['id_user'] = $q[0]['ID'];
            $_SESSION['adminlevel'] = $q[0]['ADMINLEVEL'];
            echo "Vous avez été correctement identifié par l'application. <a href='index.php'>Retour</a>";
        }
        else
        {
            $_SESSION['auth'] = false;
            echo "Erreur de connexion à l'application. <a href='index.php'>Retour</a>";
        }
    }
    else
    {
        ?>
        <div id="center">
        <fieldset>
                <h3>Connexion à l'application</h3>
                <form action="?m=1" method="POST">
                        <label for="username">Utilisateur : </label>                        
                        <input type="text" name="username" id="username"/>
                        <br/>
                        <label for="password">Password : </label>
                        <input type="text" name="password" id="password"/>
                        <br/>                        
                        <div id="centerbutton">
                        <input type="submit" value="Connexion"/>
                        </div>
                </form>
        </fieldset>
        </div>
        <?php
    }    
?>
