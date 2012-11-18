<?php

/**
 * Description of databaseManager
 *
 * @author Victor
 */
class DatabaseManager {
    
    private $database;
    
    public function  __construct(Connexion $database)
    {
        $this->database = $database;
    }
    
    public function exportTable($tableName, $schema)
    {
        if($this->database->getSgbd() == "oracle")
        {
            $res = "";
            $args = array(":TABLE_NAME" => $tableName, ":OWNER" => strtoupper($schema));
            $colonnes = $this->database->query("SELECT COLUMN_NAME, DATA_TYPE, DATA_LENGTH, DATA_PRECISION, NULLABLE, DATA_DEFAULT FROM ALL_TAB_COLUMNS WHERE TABLE_NAME=:TABLE_NAME AND OWNER=:OWNER", $args);
            $res .= "CREATE TABLE \"".strtoupper($schema)."\".\"".$tableName."\" (<br/>";
            foreach($colonnes as $colonne)
            {
                $res .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\"".$colonne['COLUMN_NAME']."\" ";
                $res .= $colonne['DATA_TYPE'];
                $res .= "(".$colonne['DATA_LENGTH'].",";
                if($colonne['DATA_PRECISION'] > 0)
                    $res .= $colonne['DATA_PRECISION'].") ";
                else
                    $res .= "0) ";
                if($colonne['NULLABLE'] == "N")
                    $res .= "NOT NULL ";
                if($colonne['DATA_DEFAULT'])
                    $res .= "\"".$colonne['DATA_DEFAULT']."\"";
                $res .= ",<br/>";
            }
            $res .= ");";
            $res .= "<br/><br/>";
            $lignes = $this->database->query("SELECT * FROM ".$tableName."");
            if(!isset($lignes["Erreur"]))
            {
                foreach($lignes as $ligne)
                {
                    $res .= "INSERT INTO \"".strtoupper($schema)."\".\"".$tableName."\" VALUES (";
                    foreach($colonnes as $colonne)
                    {
                        if($ligne[$colonne['COLUMN_NAME']] == "")
                            $res .= "NULL, ";
                        else
                        {
                            if($colonne['DATA_TYPE'] == "NUMBER")
                                $res .= $ligne[$colonne['COLUMN_NAME']].", ";
                            else
                                $res .= "'".$ligne[$colonne['COLUMN_NAME']]."', ";
                        }
                    }
                    $res = substr($res, 0, sizeof($res)-3);
                    $res .= ");<br/>";
                }
            }
            else
                $res .= $lignes["Erreur"]."<br/>";
            $res .= "<br/>";
        }
        else if($this->database->getSgbd() == "mysql")
        {
            $stucture = $this->database->query("SHOW CREATE TABLE $schema.$tableName");
            $res = $stucture[0]['Create Table'];
            $lignes = $this->database->query("SELECT * FROM $schema.$tableName");
            $colonnes = $this->database->query("SHOW COLUMNS FROM $tableName FROM $schema");
            $res .= ";<br/><br/>";
            foreach($lignes as $ligne)
            {
                $res .= "INSERT INTO ".$schema.".".$tableName." VALUES (";                
                foreach($colonnes as $colonne)
                {
                    if($ligne[$colonne['Field']] == "")
                        $res .= "NULL, ";
                    else
                    {
                        if(strpos($colonne['Type'],"int") >=0)
                            $res .= $ligne[$colonne['Field']].", ";
                        else
                            $res .= "'".$ligne[$colonne['Field']]."', ";
                    }
                }           
                $res = substr($res, 0, sizeof($res)-3);
                $res .= ");<br/>";
            }
            $res .= "<br/>";
        }
        return $res;
    }
}

?>
