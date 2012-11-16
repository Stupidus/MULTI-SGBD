<?php
global $connexion;

if($connexion->getSgbd() == "oracle")
    $dictionnaire = $connexion->query("SELECT TABLE_NAME FROM DICT");
else if($connexion->getSgbd() == "mysql")
    $dictionnaire = $connexion->query("SELECT TABLE_NAME FROM `information_schema`.`TABLES` WHERE `TABLE_SCHEMA` IN ('information_schema', 'mysql') ORDER BY `TABLE_NAME`");
?>
<table>
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
                    <th><?php echo $table['TABLE_NAME']; ?></th>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>