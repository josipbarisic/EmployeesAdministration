<?php 

include 'connection.php';
ini_set('memory_limit', '2048M');

header('Content-type: text/json');
header('Content-type: application/json; charset=utf-8');

$json_id = $_GET['json_id'];
$employee_id = $_GET['employee_id'];
$oJson = array();
$oZaposlenik = array();
$oOdjel = array();

switch($json_id)
{
	case 'get_all_employees':
		
		$sQuery = "SELECT * FROM employees LIMIT 100";
		$oRecord = $oConnection->query($sQuery);

		while($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
		{
			$oZaposlenik['emp_no'] = $oRow['emp_no'];
			$oZaposlenik['birth_date'] = $oRow['birth_date'];
			$oZaposlenik['first_name'] = $oRow['first_name'];
			$oZaposlenik['last_name'] = $oRow['last_name'];
			$oZaposlenik['gender'] = $oRow['gender'];
			$oZaposlenik['hire_date'] = $oRow['hire_date'];

			array_push($oJson, $oZaposlenik);
		}
		break;
	case 'get_ids':
		$sQuery = "SELECT emp_no FROM employees";
		$oRecord = $oConnection->query($sQuery);

		while($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
		{
			$oZaposlenik['emp_no'] = $oRow['emp_no'];

			array_push($oJson, $oZaposlenik);
		}
		break;
	case 'get_all_departments':
		$sQuery = "SELECT * FROM departments LIMIT 1000";
		$oRecord = $oConnection->query($sQuery);

		while($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
		{

			$oOdjel['dept_no'] = $oRow['dept_no'];
			$oOdjel['dept_name'] = $oRow['dept_name'];

			array_push($oJson, $oOdjel);
		}
		break;
	case 'get_employee_by_id':
		$sQuery = "SELECT * FROM employees WHERE emp_no=".$employee_id;
		$oRecord = $oConnection->query($sQuery);

		while($oRow = $oRecord->fetch(PDO::FETCH_BOTH))
		{
			$oZaposlenik['emp_no'] = $oRow['emp_no'];
			$oZaposlenik['birth_date'] = $oRow['birth_date'];
			$oZaposlenik['first_name'] = $oRow['first_name'];
			$oZaposlenik['last_name'] = $oRow['last_name'];
			$oZaposlenik['gender'] = $oRow['gender'];
			$oZaposlenik['hire_date'] = $oRow['hire_date'];

			array_push($oJson, $oZaposlenik);
		}
		break;
}

$json = json_encode($oJson);
$fopen = fopen('results.json', 'w');
fwrite($fopen, $json);
fclose($fopen);

echo "<h1>Results are in the `results.json` file.</h1>";
 ?>