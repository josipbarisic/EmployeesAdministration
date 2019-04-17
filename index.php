<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<title>Homepage</title>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<!-- ADD EMPLOYEE FORM -->
	<form action="action.php" method='POST' style="display: inline-block;">
		<!-- ACTION_ID -->
		<input type="hidden" name="action_id" value="add_employee">
		<h2>Add new employee</h2>
		<div class="formDiv" style="width: 400px; box-sizing: border-box; padding: 10px">
			<label>Birth Date:</label>
			<input class="form-control" type="date" name="birthDate">
			<hr>
			<label>First Name:</label>
			<input class="form-control" type="text" name="firstName">
			<hr>
			<label>Last Name:</label>
			<input class="form-control" type="text" name="lastName">
			<hr>
			<label>Gender:</label>
			<br>
			<span>Male&nbsp;</span><input type="radio" name="gender" value="M">
			&nbsp;&nbsp;
			<span>Female&nbsp;</span><input type="radio" name="gender" value="F">
			<hr>
			<label>Hire Date:</label>
			<input class="form-control" type="date" name="hireDate">
			<hr>
			<button class='btn btn-primary' type="submit">ADD EMPLOYEE</button>
		</div>
	</form>

	<!-- UPDATE EMPLOYEE FORM -->
	<form id="updateForm" action="action.php" method="POST" style="display: inline-block;">
		<!-- ACTION_ID -->
		<input type="hidden" name="action_id" value="update_employee">
		<input type="hidden" name="employee_id" id="updateInput">
		<h2 id="updateTitle">Update employee: (select id)</h2>
		<div class="formDiv" style="width: 400px; box-sizing: border-box; padding: 10px">
			<label>Birth Date:</label>
			<input class="form-control" type="date" name="birth_date">
			<hr>
			<label>First Name:</label>
			<input class="form-control" type="text" name="first_name">
			<hr>
			<label>Last Name:</label>
			<input class="form-control" type="text" name="last_name">
			<hr>
			<label>Gender:</label>
			<br>
			<span>Male&nbsp;</span><input type="radio" name="gen_der" value="M">
			&nbsp;&nbsp;
			<span>Female&nbsp;</span><input type="radio" name="gen_der" value="F">
			<hr>
			<label>Hire Date:</label>
			<input class="form-control" type="date" name="hire_date">
			<hr>
			<button class='btn btn-primary' type="submit">UPDATE EMPLOYEE</button>
		</div>
	</form>

<?php 

include "connection.php";

ini_set('memory_limit', '2048M');

$sQuery = "SELECT * FROM employees ORDER BY emp_no LIMIT 100";

$oResponse = $oConnection->query($sQuery);

$oEmployees = array();

//POUNJAVANJE POLJA PODACIMA IZ TABLICE
while($oRow = $oResponse->fetch(PDO::FETCH_BOTH))
{
	$id = $oRow['emp_no'];
	$bd = $oRow['birth_date'];
	$fn = $oRow['first_name'];
	$ln = $oRow['last_name'];
	$g = $oRow['gender'];
	$hd = $oRow['hire_date'];

	$oEmployee = new Employee($id, $bd, $fn, $ln, $g, $hd);

	array_push($oEmployees, $oEmployee);
}

//HTML TABLICA (TL;DR)
echo "
		<table class='limiter wrap-table100 table table-striped'>
		<tr class='row header'>
			<th class='cell' style='display:inline-block; width: 15vh; text-align:center;'>Rbr.</th>
			<th class='cell' style='display:inline-block; width: 15vh; text-align:center;'>Id</th>
			<th class='cell' style='display:inline-block; width: 15vh; text-align:center;'>Birth Date</th>
			<th class='cell' style='display:inline-block; width: 15vh; text-align:center;'>First Name</th>
			<th class='cell' style='display:inline-block; width: 15vh; text-align:center;'>Last Name</th>
			<th class='cell' style='display:inline-block; width: 15vh; text-align:center;'>Gender</th>
			<th class='cell' style='display:inline-block; width: 15vh; text-align:center;'>Hire Date</th>
		</tr>";

$rbr = 0;
foreach ($oEmployees as $emp) {
	$rbr += 1;
	echo "<tr class='row'>
			<td class='cell' style='display:inline-block; width: 15vh; text-align:center;'>".$rbr."</td>
			<td class='cell' style='display:inline-block; width: 15vh; text-align:center;'>".$emp->emp_no."</td>
			<td class='cell' style='display:inline-block; width: 15vh; text-align:center;'>".$emp->birth_date."</td>
			<td class='cell' style='display:inline-block; width: 15vh; text-align:center;'>".$emp->first_name."</td>
			<td class='cell' style='display:inline-block; width: 15vh; text-align:center;'>".$emp->last_name."</td>
			<td class='cell' style='display:inline-block; width: 15vh; text-align:center;'>".$emp->gender."</td>
			<td class='cell' style='display:inline-block; width: 15vh; text-align:center;'>".$emp->hire_date."</td>

			<th class='cell' style='display:inline-block; width: 15vh; text-align:center;'><button class='btn btn-primary' name='employee_id' onclick='jsGetEmployeeId(".$emp->emp_no.")''>Update</button></th>

			<th class='cell' style='display:inline-block; width: 15vh; text-align:center;'><form action='action.php' method='POST' class='formButton'><input type='hidden' name='action_id' value='delete_employee'/><input name='employee_id' type='hidden' value='".$emp->emp_no."'/><button class='btn btn-primary' type='submit'>Delete</button></form></th>
		</tr>";
}
echo "</table>";


 ?>

 <script type="text/javascript">
	var formTitle = document.querySelector("#updateTitle");
	var title = formTitle.textContent;
	var updateButton = document.querySelector("#updateButton");
	function jsGetEmployeeId($empId)
	{
		var string = "Update employee: (ID)" + $empId;
		formTitle.textContent = string;
		document.querySelector("#updateInput").setAttribute("value", $empId);
		document.querySelector("#updateForm").scrollIntoView();

	}

</script>
 </body>
</html>