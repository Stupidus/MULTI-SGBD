<?php
global $connexion, $connexion_bdd;
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
        {   
            if($_POST['type_sauvegarde'] == "froid")
            {
                echo "shutdown immediate <br/>";
                $listeFichiers = array();
                $listeFichiers[] = $connexion_bdd->query("select 'host copy  ' || name || ' ".$_POST['repertoire']." ' BACKUP from v\$datafile order by 1");
                $listeFichiers[] = $connexion_bdd->query("select 'host copy  ' || member || ' ".$_POST['repertoire']." ' BACKUP from v\$logfile order by 1");
                $listeFichiers[] = $connexion_bdd->query("select 'host copy  ' || name  || ' ".$_POST['repertoire']." ' BACKUP from v\$controlfile order by 1");
                $listeFichiers[] = $connexion_bdd->query("select 'host copy  ' || name  || ' ".$_POST['repertoire']." ' BACKUP from v\$tempfile order by 1");
                foreach($listeFichiers as $fichiers)
                {
                    foreach($fichiers as $requete)
                        echo $requete["BACKUP"]."<br/>";
                }
                echo "startup<br/>";
            }
            else
            {
                echo "spool ".$_POST['fichier']." <br/>";
                echo "archive log list <br/>";
                echo "alter system switch logfile <br/>";
                $listeFichiers = array();
                $listeFichiers[] = $connexion_bdd->query("SELECT ' alter tablespace ' || tablespace_name || ' begin backup  ; ' BACKUP FROM dba_tablespaces WHERE status NOT IN ('READ ONLY', 'INVALID', 'OFFLINE')");
                $listeFichiers[] = $connexion_bdd->query("SELECT ' host copy ' || file_name || ' ".$_POST['repertoire']." ' BACKUP FROM dba_data_files WHERE tablespace_name NOT IN (SELECT tablespace_name FROM dba_tablespaces WHERE status IN ('READ ONLY', 'INVALID', 'OFFLINE'))");
                $listeFichiers[] = $connexion_bdd->query("SELECT ' alter tablespace ' || tablespace_name || ' end backup  ; ' BACKUP FROM dba_tablespaces WHERE status NOT IN ('READ ONLY', 'INVALID', 'OFFLINE')");
                foreach($listeFichiers as $fichiers)
                {
                    foreach($fichiers as $requete)
                        echo $requete["BACKUP"]."<br/>";
                }
                echo "alter database backup controlfile to '".$_POST['repertoire']."/control.ctl' REUSE <br/>";
                echo "alter system switch logfile <br/>";
                echo "archive log list <br/>";
                echo "spool off <br/>";
            }
        }
        else if($connexion_bdd->getSgbd() == "mysql")
        {
            $infosBdd = $connexion->query("SELECT * FROM CONNEXIONS WHERE ID = :ID", array(":ID" => $_SESSION['connexion_id']));
            $listeDatabases = $connexion_bdd->query("SHOW DATABASES");
            foreach($listeDatabases as $database)
            {
                echo "mysqlhotcopy -u ".$infosBdd[0]['USERNAME']." -p".$infosBdd[0]['PASSWORD']." ".$database['Database']." ".$_POST['repertoire']."<br/>";
            }
        }
        break;
    default:
        ?>
        <div id="center">
            <fieldset>
            <form action="?cat=7&amp;m=1" method="post">
                <label for="type_sauvegarde">Type de sauvegarde (uniquement pour oracle): </label>
                <select name="type_sauvegarde" id="type_sauvegarde">
                    <option value="froid">Sauvegarde à froid</option>
                    <option value="chaud">Sauvegarde à chaud</option>
                </select>
                <br/>
                <label for="repertoire">Répertoire de destination : </label>
                <input type="text" name="repertoire" id="repertoire"/>
                <br/>
                <label for="fichier">Fichier de destination (uniquement pour sauvegarde à chaud oracle) : </label>
                <input type="text" name="fichier" id="fichier"/>
                <br/>
                <div id="centerbutton">
                <input type="submit" value="Connexion"/>
                </div>
            </form>
            </fieldset>
        </div>
        <?php
        break;
}
?>