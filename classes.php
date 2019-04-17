<?php 

class Configuration
{
	public $host = "localhost";
	public $dbName = "testdb";
	public $username = "root";
	public $password = "";

	// public function __construct($host, $dbName, $username, $password)
	// {
	// 	$this->host = $host;
	// 	$this->dbName = $dbName;
	// 	$this->username = $username;
	// 	$this->password = $password;
	// }
}

class Employee
{
	public $emp_no = "N/A";
	public $birth_date ="N/A";
	public $first_name = "N/A";
	public $last_name = "N/A";
	public $gender = "N/A";
	public $hire_date = "N/A";

	public function __construct($emp_no=null, $birth_date=null, $first_name=null, $last_name=null, $gender=null, $hire_date=null)
	{
		if($emp_no) $this->emp_no = $emp_no;
		if($birth_date) $this->birth_date = $birth_date;
		if($first_name) $this->first_name = $first_name;
		if($last_name) $this->last_name = $last_name;
		if($gender) $this->gender = $gender;
		if($hire_date) $this->hire_date = $hire_date;
	}
}

class Department
{
	public $dept_no = "N/A";
	public $dept_name = "N/A";

	public function __construct($dept_no=null, $dept_name=null)
	{
		if($dept_no) $this->dept_no = $dept_no;
		if($dept_name) $this->dept_name = $dept_name;
	}
}

 ?>
