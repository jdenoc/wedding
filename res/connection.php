<?php
/**
 * Author: Denis O'Connor
 * Last Modified: 13-OCT-2012
 */
class pdo_connection{

    private $db;
    private $host="localhost"; 				// Host name
    private $username="jdenocco_root"; 		// Mysql username
    private $password="root_pass"; 			// Mysql password

    public function __construct($db_name){
        $this->db = new PDO(
            "mysql:host=$this->host;dbname=$db_name",
            $this->username,
            $this->password
        );
    }

    public function getAllRows($stmt, $bind=array()){
        $query = $this->db->prepare($stmt);
        foreach($bind as $key=>$item){
            $query->bindValue(':'.$key, $item, PDO::PARAM_STR);
        }
        $query->execute();
        return $query->fetchAll();
    }

    public function getValue($stmt, $bind=array()){
        $query = $this->db->prepare($stmt);
        /*** bind the paramaters ***/
        foreach($bind as $key=>$item){
            $query->bindParam(':'.$key, $item, PDO::PARAM_STR);
        }
        $query->execute();
        return $query->fetchColumn();
    }

    public function getAllValues($stmt, $bind=array()){
        $query = $this->db->prepare($stmt);
        $array = array();
        /*** bind the paramaters ***/
        foreach($bind as $key=>$item){
            $query->bindParam(':'.$key, $item, PDO::PARAM_STR);
        }
        $query->execute();
        $rows = $query->rowCount();
        for($i=0; $i<$rows; $i++){
            $array[] = $query->fetchColumn();
        }
        return $array;
    }

    public function getRow($stmt, $bind=array()){
        $query = $this->db->prepare($stmt);
        /*** bind the paramaters ***/

        foreach($bind as $key=>$item){
            $query->bindValue(':'.$key, $item, PDO::PARAM_STR);
        }
        $query->execute();
        return $query->fetch();
    }

    public function insert($tbl_name, $array=array()){
        $values = '';
        foreach($array as $key=>$value){
            $value = (get_magic_quotes_gpc())? stripslashes($value) : $value;
            $values .= " $key='$value',";
        }
        $values = substr($values, 0, strlen($values)-1);

        return $this->db->exec("INSERT INTO $tbl_name SET $values");
    }

    public function update($tbl_name, $array=array(), $whereArray=array()){
        $values = '';
        foreach($array as $key=>$value){
            $value = (get_magic_quotes_gpc())? stripslashes($value) : $value;
            $values .= " $key='$value',";
        }
        $values = substr($values, 0, strlen($values)-1);

        $where = '';
        foreach($whereArray as $key=>$value){
            $value = (get_magic_quotes_gpc())? stripslashes($value) : $value;
            $where .= " $key=".((isset($value))? "'$value'," : null);
        }
        $where = substr($where, 0, strlen($where)-1);

//        echo "UPDATE ".$tbl_name." SET ".$values." WHERE ".$where;
        return $this->db->exec("UPDATE $tbl_name SET $values WHERE $where");
    }

    public function delete($tbl_name, $array=array()){
        $values = '';
        foreach($array as $key=>$value){
            $values .= " $key='$value',";
        }
        $values = substr($values, 0, strlen($values)-1);

        return $this->db->exec("DELETE FROM $tbl_name WHERE $values");
    }

    public function closeConnection(){
        $this->db = null;
    }
}
