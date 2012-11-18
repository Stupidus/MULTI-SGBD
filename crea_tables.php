<?php
global $connexion_bdd;
include 'classes/databaseManager.class.php';
$databaseManager = new DatabaseManager($connexion_bdd);

echo "<a href='".$_SERVER['HTTP_REFERER']."'>Retour</a><br/><br/>";

if(isset($_GET['m']) && !empty($_GET['m']))
    $m = $_GET['m'];
else
    $m = null;    
switch($m)
{
    case 1:
        if($connexion_bdd->getSgbd() == "oracle")
            $listeTables = $connexion_bdd->query("SELECT TABLE_NAME FROM ALL_TABLES WHERE OWNER = :OWNER", array(":OWNER" => $_GET['owner']));
        else if($connexion_bdd->getSgbd() == "mysql")
            $listeTables = $connexion_bdd->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = :TABLE_SCHEMA", array(":TABLE_SCHEMA" => $_GET['owner']));        
        
        foreach ($listeTables as $table)
        {
            echo $databaseManager->exportTable($table['TABLE_NAME'], $_GET['owner']);                
        }
        break;
    default:
        if($connexion_bdd->getSgbd() == "oracle")
            $schemas = $connexion_bdd->query("SELECT USERNAME FROM ALL_USERS ORDER BY USERNAME");
        else if($connexion_bdd->getSgbd() == "mysql")
            $schemas = $connexion_bdd->query("SELECT DISTINCT TABLE_SCHEMA USERNAME FROM INFORMATION_SCHEMA.TABLES");        
        ?>
        <table style="border:1px solid black;">
            <thead>
                <tr>
                    <th>SCHEMA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($schemas as $schema)
                    {
                        ?>
                        <tr>
                            <td><a href="?cat=6&amp;m=1&amp;owner=<?php echo $schema['USERNAME']; ?>"><?php echo $schema['USERNAME']; ?></a></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
        <?php
        break;
}
?>