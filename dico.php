<?php
global $connexion, $connexion_bdd;

echo "<a href='".$_SERVER['HTTP_REFERER']."'>Retour</a><br/><br/>";

if(isset($_GET['m']) && !empty($_GET['m']))
    $m = $_GET['m'];
else
    $m = null;    
switch($m)
{
    case 1:
        if($connexion_bdd->getSgbd() == "oracle")
            $contenuTable = $connexion_bdd->query("SELECT * FROM ".$_GET['table_name']."");
        else if($connexion_bdd->getSgbd() == "mysql")
            $contenuTable = $connexion_bdd->query("SELECT * FROM `information_schema`.".$_GET['table_name']."");
        
        if(sizeof($contenuTable) > 0)
        {
            ?>
            <table style="border:1px solid black;">
                <thead>
                    <tr>
                        <?php
                            $clesTable = array_keys($contenuTable[0]);
                            foreach($clesTable as $cle)
                            {
                                echo "<th>".$cle."</th>";
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($contenuTable as $contenu)
                        {
                            echo "<tr>";
                            foreach($clesTable as $cle)
                            {
                                echo "<td>".$contenu[$cle]."</td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
            <?php
        }
        else echo "La table demandée est vide";
        break;
    case 2:
        $infosBdd = $connexion->query("SELECT * FROM CONNEXIONS WHERE ID = :ID", array(":ID" => $_SESSION['connexion_id']));
        if($connexion_bdd->getSgbd() == "oracle")
            $dictionnaire = $connexion_bdd->query("SELECT TABLE_NAME FROM ALL_TABLES WHERE OWNER = :OWNER", array(":OWNER" => strtoupper($infosBdd[0]['USERNAME'])));
        else if($connexion_bdd->getSgbd() == "mysql")
            $dictionnaire = $connexion_bdd->query("SELECT TABLE_NAME FROM `information_schema`.`TABLES` WHERE `TABLE_SCHEMA` IN ('information_schema', 'mysql') ORDER BY `TABLE_NAME`");
        ?>
        <table style="border:1px solid black;">
            <thead>
                <tr>
                    <th>TABLE_NAME</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($dictionnaire as $table)
                    {
                        ?>
                        <tr>
                            <td><a href="?cat=5&amp;m=1&amp;table_name=<?php echo $table['TABLE_NAME']; ?>"><?php echo $table['TABLE_NAME']; ?></a></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
        <?php
        break;
    default:
        if($connexion_bdd->getSgbd() == "oracle")
            $dictionnaire = $connexion_bdd->query("SELECT TABLE_NAME FROM DICT");
        else if($connexion_bdd->getSgbd() == "mysql")
            $dictionnaire = $connexion_bdd->query("SELECT TABLE_NAME FROM `information_schema`.`TABLES` WHERE `TABLE_SCHEMA` IN ('information_schema', 'mysql') ORDER BY `TABLE_NAME`");
        ?>
        <table style="border:1px solid black;">
            <thead>
                <tr>
                    <th>TABLE_NAME</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($dictionnaire as $table)
                    {
                        ?>
                        <tr>
                            <td><a href="?cat=5&amp;m=1&amp;table_name=<?php echo $table['TABLE_NAME']; ?>"><?php echo $table['TABLE_NAME']; ?></a></td>
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