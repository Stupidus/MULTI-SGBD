<fieldset><legend>Liste des connexions existantes</legend>
<?php
    global $connexion;
    if($_SESSION['adminlevel'] > 0)
        $listeConnexions = $connexion->query("SELECT * FROM CONNEXIONS ORDER BY ID");
    else
        $listeConnexions = $connexion->query("SELECT * FROM CONNEXIONS WHERE USER_ID = :USER_ID ORDER BY ID", array(":USER_ID" => $_SESSION['id_user']));

    foreach($listeConnexions as $connect)
    {
        echo "<a href='?cat=1&amp;connexion_id=".$connect['ID']."'>".$connect['LABEL']."</a> <a href='?cat=1&amp;m=2&amp;connexion_id=".$connect['ID']."'>Supprimer</a><br/>";
    }
    ?>
</fieldset>
<div class="center">
<fieldset>
	<h3>Ajouter une connexion à une base de données</h3>
	<form action="?cat=1&amp;m=1" method="POST">
                <label for="label">Label : </label>
		<input type="text" name="label" id="label"/>
		<br/>
		<label for="sgbd">SGBD : </label>
		<select name="sgbd" id="sgbd">
			<option></option>
			<option value="mysql">MySQL</option>
			<option value="oracle">Oracle</option>
		</select>
		<br/>
		<label for="host">Host : </label>
		<input type="text" name="host" id="host"/>
		<br/>
		<label for="port">Port : </label>
		<input type="text" name="port" id="port"/>
		<br/>
		<label for="dbname">Base de données : </label>
		<input type="text" name="dbname" id="dbname"/>
		<br/>
		<label for="username">Utilisateur : </label>
		<input type="text" name="username" id="username"/>
		<br/>
		<label for="password">Mot de passe : </label>
		<input type="password" name="password" id="password"/>
		<br/></br>
		<div id="centerbutton">
                    <input type="submit" value="Ajouter"/>
		</div>
	</form>
</fieldset>
</div>
<?php if ($_SESSION['adminlevel'] > 0) { ?>
    <fieldset><legend>Liste des utilisateurs existants</legend>
    <?php
        if($_SESSION['adminlevel'] > 0)
            $listeUsers = $connexion->query("SELECT * FROM USERS ORDER BY ID");        

        foreach($listeUsers as $user)
        {
            echo "<a href='?cat=4&amp;user_id=".$user['ID']."'>".$user['USERNAME']."</a> <a href='?cat=4&amp;m=2&amp;user_id=".$user['ID']."'>Supprimer</a><br/>";
        }
        ?>
    </fieldset>
    <div class="center">
        <br/>
        <fieldset>
            <h3>Ajouter un utilisateur</h3>
            <form action="?cat=4&amp;m=1" method="POST">            
                    <label for="username">Utilisateur : </label>
                    <input type="text" name="username" id="username"/>
                    <br/>
                    <label for="password">Mot de passe : </label>
                    <input type="password" name="password" id="password"/>
                    <br/></br>
                    <div id="centerbutton">
                        <input type="submit" value="Ajouter"/>
                    </div>
            </form>
        </fieldset>
    </div>
<?php } ?>