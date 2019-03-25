<?php

class databaseConfig {

  private $servername;
  private $username;
  private $password;
  private $dbname;
  
  public function __construct($cfgFile) {
    $cfg = parse_ini_file($cfgFile);

    $this->servername = $cfg['servername'];
    $this->username = $cfg['username'];
    $this->password = $cfg['password'];
    $this->dbname = $cfg['dbname'];
  }

  public function servername() {
    return $this->servername;
  }

  public function username() {
    return $this->username;
  }

  public function password() {
    return $this->password;
  }

  public function dbname() {
    return $this->dbname;
  }
}
?>