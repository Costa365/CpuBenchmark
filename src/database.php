<?php

require_once('src/cpu.php');
require_once('src/databaseConfig.php');

class database {

  private $conn;
  
  public function __construct($dbCfg) {    
    $this->conn = new mysqli(
      $dbCfg->servername(), $dbCfg->username(), 
      $dbCfg->password(), $dbCfg->dbname());
  }
  
  public function __destruct() {
    if($this->conn) {
      $this->conn->close();
    }
  }

  public function connectionStatus() {
    return $this->conn->connect_error==false;
  }

  public function getConnectionError() {
    return $this->conn->connect_error;
  }

  public function getQueryResults($sql) {
    $results = array();
    $queryResult = $this->conn->query($sql);

    while($row = $queryResult->fetch_assoc()) {
      $resultDict = cpu::dbRowToDictionary($row);
      $results[] = $resultDict;
    }
    return $results;
  }
}
?>