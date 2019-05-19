<?php

require_once('src/database.php');

function headers() {
  // Headers for not caching the results
  header('Cache-Control: no-cache, must-revalidate');
  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

  // Headers to tell that result is JSON
  header('Content-type: application/json');
}

function getCpuConnection() {
  $dbConfig = new databaseConfig('config/database.ini');
  $conn = new database($dbConfig);
  return $conn;
}

function sanitize($cpuName) {
  $cpuName = str_replace(";","",$cpuName);
  $cpuName = str_replace("'","",$cpuName);
  $cpuName = str_replace("\"","",$cpuName);
  $cpuName = str_replace("#","",$cpuName);
  $cpuName = str_replace("--","",$cpuName);
  return $cpuName;
}

function getCpuInfo($conn, $cpuName) {
  $results = array();

  $cpuName = sanitize($cpuName);  
	
  if (empty($cpuName)){
    return $results;
  }

  if ($conn->connectionStatus) {
    die("Connection failed: " . $conn->getConnectionError());
  }

  // Not safe, but biz.nf doesn't support prepare
  $sql = "SELECT * from CPUs where Name like '%$cpuName%'";
  $results = $conn->getQueryResults($sql);

  return $results;
}

$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$resultJson = getCpuInfo(getCpuConnection(), $request[0]);
headers();
echo json_encode($resultJson);
?>
