<?php
include "connection.php";

$sQueryInsert = "INSERT INTO employees (birth_date, first_name, last_name, gender,
hire_date) VALUES (:birthDate, :firstName, :lastName, :gender, :hireDate)";

$oInsertStatement = $oConnection->prepare($sQueryInsert);

$action = '';
if(!empty($_POST['action_id']))
{
	$action = $_POST['action_id'];
}

$employeeId = null;

if(!empty($_POST['employee_id']))
{
	$employeeId = $_POST['employee_id'];
}




switch ($action) {
	case 'add_employee':
		if(!empty($_POST['birthDate']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['gender']) && !empty($_POST['hireDate']))
		{
			$oData = array(
				'birthDate' => $_POST['birthDate'],
				'firstName' => $_POST['firstName'],
				'lastName' => $_POST['lastName'],
				'gender' => $_POST['gender'],
				'hireDate' => $_POST['hireDate'],
			);

			$oInsertStatement->execute($oData);
			
			echo "<h1>Employee added succesfully.</h1>
					<button onclick='homepage()'>Back to Homepage</button>";
		}
		else
		{
			echo "All fields are necesary!";
		}
		break;
	case "update_employee":
		$arr = array();
		$setQuery = conditions();
		$sQueryUpdate = "UPDATE lv4baza.employees SET ".$setQuery." WHERE emp_no=".$employeeId;

		$oUpdateStatement = $oConnection->query($sQueryUpdate);
			
		echo "<h1>Employee updated succesfully.</h1>
				<button onclick='homepage()'>Back to Homepage</button>";

		break;
	case "delete_employee":
		$sQueryDelete = "DELETE FROM lv4baza.employees WHERE emp_no=".$employeeId;

		$oUpdateStatement = $oConnection->query($sQueryDelete);
			
		echo "<h1>Employee deleted succesfully.</h1>
				<button onclick='homepage()'>Back to Homepage</button>";

		break;

	default:
		echo "<h1>400 Bad Request</h1>";
		break;
}

function conditions()
{
	$string = '';
	if(!empty($_POST['birth_date']))
	{
		$date = $_POST['birth_date'];
		$string .= "birth_date='".(string)$date."', ";
	}
	if(!empty($_POST['first_name']))
	{
		$string .= "first_name='".$_POST['first_name']."', ";
	}
	if(!empty($_POST['last_name']))
	{
		$string .= "last_name='".$_POST['last_name']."', ";
	}
	if(!empty($_POST['gen_der']))
	{
		$string .= "gender='".$_POST['gen_der']."', ";
	}
	if(!empty($_POST['hire_date']))
	{
		$string .= "hire_date='".$_POST['hire_date']."'";
	}
	return $string;
}

$_POST = array();
$_POST['action_id'] = '';

?>

<script type="text/javascript">
	function homepage()
	{
		window.location.href = "index.php";
	}
</script>