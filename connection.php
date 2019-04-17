<?php 
include "classes.php";

$oConfig = new Configuration();

try
{
	$oConnection = new PDO("mysql:host=$oConfig->host;dbname=$oConfig->dbName;", $oConfig->username, $oConfig->password);
	// echo "Connected to DB.";
}
catch(PDOException $err)
{
	echo "Connection failed: ".$err->getMessage();
}

 ?>