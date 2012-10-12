<form action="?cat=0" method="POST">
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
    <label for="username">Utilisateur : </label>
    <input type="text" name="username" id="username"/>
    <br/>
    <label for="password">Mot de passe : </label>
    <input type="password" name="password" id="password"/>
    <br/>
    <input type="submit" value="Connexion"/>
</form>
