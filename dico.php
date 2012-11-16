<?php
global $connexion, $connexion_bdd;

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
                    <td><?php echo $table['TABLE_NAME']; ?></td>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>