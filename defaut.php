<div id="center">
    Liste des connexions existantes :<br/><br/>
    <?php
        if($_SESSION['adminlevel'] > 0)
            $listeConnexions = $connexion->query("SELECT * FROM CONNEXIONS");
        else
            $listeConnexions = $connexion->query("SELECT * FROM CONNEXIONS WHERE USER_ID = :USER_ID", array(":USER_ID" => $_SESSION['id_user']));
        
        var_dump($listeConnexions)
    ?>
<fieldset>
	<h3>Ajouter une connexion à une base de données</h3>
	<form action="?cat=1" method="POST">
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
		<input type="submit" value="Connexion"/>
		</div>
	</form>
</fieldset>
</div>