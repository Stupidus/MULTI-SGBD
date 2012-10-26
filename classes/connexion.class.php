<?php
/**
 * Description of connexion
 *
 * @author Victor
 */
class Connexion {
    
    private $pdo;
    
    public function  __construct($SGBD, $host, $dbname, $username, $password, $port)
    {
        try
        {
            switch($SGBD)
            {
                case "mysql":
                    $this->pdo = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$dbname.'', $username, $password);
                    $this->pdo->query("SET NAMES UTF8");
                    break;
                case "oracle":
                    $tns = "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = ".$host.")(PORT = ".$port."))) (CONNECT_DATA = (SERVICE_NAME = ".$dbname.")))";
                    $this->pdo = new PDO("oci:dbname=".$tns, $username, $password);
                    $this->pdo->query("SET NAMES UTF8");
                    break;
                default:
                    throw new Exception("SGBD incorrect");
                    break;
            }
            
        }
        catch (Exception $e)
        {
            throw new Exception("Connection to database '".$dbname."' failed. (".$e->getMessage().")");
        }
    }
    
    public function query($statement, $args = NULL)
    {
        $q = $this->pdo->prepare($statement);
        if($args)
        {
            foreach($args as $value => $key)
            {
                echo "Bind ".$key." à ".$value."<br/>";
                $q->bindValue($key, $value);
            }
        }
        if($q->execute())
        {
            $res = $q->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            $erreur = $q->errorInfo();
            $res = array("Erreur" => $erreur[2]);
        }
        return $res;
    }
}
?>