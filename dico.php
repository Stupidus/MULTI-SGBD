<?php
global $connexion, $connexion_bdd;

if(isset($_GET['m']) && !empty($_GET['m']))
    $m = $_GET['m'];
else
    $m = null;    
switch($m)
{
    case 1:
        $contenuTable = $connexion_bdd->query("SELECT * FROM :TABLE_NAME", array(":TABLE_NAME" => $_GET['table_name']));
        var_dump($contenuTable);
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