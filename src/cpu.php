<?php 
class cpu {

  public static function dbRowToDictionary($dbRow) {
    $resultDictionary = array(
      'name' => $dbRow["Name"], 
      'cores' => $dbRow["Cores"], 
      'threads' => $dbRow["Threads"], 
      'cpuType' => $dbRow["Type"], 
      'cpuMark' => $dbRow["CpuMark"],
      'singleThreadMark' => $dbRow["SingleThreadMark"], 
      'tdp' => $dbRow["TDP"] . "W", 
      'powerPerf' => $dbRow["PowerPerf"],
      'socket' => $dbRow["Socket"], 
      'releaseDate' => $dbRow["ReleaseDate"]
      );
      return $resultDictionary;
  }
}
?>