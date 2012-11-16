<?php
global $connexion, $connexion_bdd;

if($connexion->getSgbd() == "oracle")
    $dictionnaire = $connexion_bdd->query("SELECT TABLE_NAME FROM DICT");
else if($connexion->getSgbd() == "mysql")
    $dictionnaire = $connexion_bdd->query("SELECT TABLE_NAME FROM `information_schema`.`TABLES` WHERE `TABLE_SCHEMA` IN ('information_schema', 'mysql') ORDER BY `TABLE_NAME`");
var_dump($dictionnaire);
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
                    <td><?php echo $table['TABLE_NAME']; ?></td>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>