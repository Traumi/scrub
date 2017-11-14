<?php

define('BDD_HOST', 'localhost');     // aquabdd
define('BDD_LOGIN', 'root');         // nÂ° Ã©tudiant
define('BDD_MDP', 'root');               // password Ã©tudiant
define('BDD_DATABASE', 'scrum');       // promotion16
define('BDD_DRIVER', 'mysql');       // pgsql

class SPDO{
  private $PDOInstance = null;
  private static $instance = null;

  private  function __construct(){
    try {
      $this->PDOInstance = new PDO(BDD_DRIVER.':dbname='.BDD_DATABASE.';host='.BDD_HOST, BDD_LOGIN, BDD_MDP);
      $this->PDOInstance->query('SET NAMES utf8');
  	  $this->PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e){
      die('<p>La connexion a Ã©chouÃ©. Erreur['.$e->getCode().'] : '.$e->getMessage().'</p>');
    }
  }

  public static function getDB(){
    if (is_null(self::$instance))
      self::$instance = new SPDO();
    return self::$instance;
  }

  public function query($query){
    return $this->PDOInstance->query($query);
  }

  public function prepare($query){
    return $this->PDOInstance->prepare($query);
  }

  public function lastInsertId($name=''){
    return $this->PDOInstance->lastInsertId($name);
  }



}

?>
