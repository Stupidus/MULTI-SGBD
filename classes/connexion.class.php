<?php
/**
 * Description of connexion
 *
 * @author Victor
 */
class Connexion {
    
    private $pdo;
    private $oci;
    private $SGBD;
    
    public function  __construct($SGBD, $host, $dbname, $username, $password, $port = '3306')
    {
        $this->SGBD = $SGBD;
        try
        {
            switch($SGBD)
            {
                case "mysql":
                    $this->pdo = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$dbname.'', $username, $password);
                    $this->pdo->query("SET NAMES UTF8");
                    break;
                case "oracle":
                    $this->oci = oci_connect($username, $password, $host);
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
        if($this->SGBD == "oracle")
        {
            
        }
        else
        {
            $q = $this->pdo->prepare($statement);
            foreach($args as $key => $value)
            {
                $q->bindValue($key, $value);
            }
            $q->execute();
            $res = $q->fetchAll(PDO::FETCH_ASSOC);
        }
        return $res;
    }
}

?>
