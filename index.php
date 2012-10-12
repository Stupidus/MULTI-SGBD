<?php
    require_once 'fonctions.php';
    require_once 'classes/connexion.class.php';
    
    if(isset($_GET['cat']) && !empty($_GET['cat']))
        $cat = $_GET['cat'];
    else
        $cat = null;    
    
    switch($cat)
    {     
        default:            
            $content = get_include_contents('defaut.php');
            break;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" media="all" href="/styles.css" />
        <title>MULTI-SGBD</title>
    </head>
    <body>
        <?php echo $content; ?>
    </body>
</html>
