<?php 

$host = "localhost";
$username = "root";
$password = "";

try
{
	$oConn = new PDO("mysql:host=$host", $username, $password);
	$oConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$query = "CREATE DATABASE lv4baza";

	// $oConn->exec($query);
	// echo "Baza podataka kreirana.<br>";

}
catch(PDOException $err)
{
	echo "--------------------<br>";
	echo $query."<br>".$err->getMessage();
	echo "<br>--------------------<br>";
}

$sQuery = 'CREATE TABLE IF NOT EXISTS `lv4baza`.`employees` (
  `emp_no` INT NOT NULL AUTO_INCREMENT,
  `birth_date` DATE NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `gender` VARCHAR(45) NULL,
  `hire_date` DATETIME NULL,
  PRIMARY KEY (`emp_no`))
ENGINE = InnoDB;



CREATE TABLE IF NOT EXISTS `lv4baza`.`salaries` (
  `emp_no` INT NOT NULL,
  `salary` INT NULL,
  `from_date` DATETIME NOT NULL,
  `to_date` DATETIME NULL,
  PRIMARY KEY (`from_date`),
  INDEX `fk_salaries_employees1_idx` (`emp_no` ASC),
  CONSTRAINT `fk_salaries_employees1`
    FOREIGN KEY (`emp_no`)
    REFERENCES `lv4baza`.`employees` (`emp_no`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



CREATE TABLE IF NOT EXISTS `lv4baza`.`titles` (
  `emp_no` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `from_date` DATETIME NOT NULL,
  `to_date` DATETIME NULL,
  PRIMARY KEY (`from_date`, `title`),
  INDEX `fk_titles_employees1_idx` (`emp_no` ASC),
  CONSTRAINT `fk_titles_employees1`
    FOREIGN KEY (`emp_no`)
    REFERENCES `lv4baza`.`employees` (`emp_no`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



CREATE TABLE IF NOT EXISTS `lv4baza`.`departments` (
  `dept_no` INT NOT NULL,
  `dept_name` VARCHAR(45) NULL,
  PRIMARY KEY (`dept_no`))
ENGINE = InnoDB;



CREATE TABLE IF NOT EXISTS `lv4baza`.`dept_manager` (
  `dept_no` INT NULL,
  `emp_no` INT NOT NULL,
  `to_date` DATETIME NULL,
  INDEX `fk_dept_manager_departments1_idx` (`dept_no` ASC),
  INDEX `fk_dept_manager_employees1_idx` (`emp_no` ASC),
  CONSTRAINT `fk_dept_manager_departments1`
    FOREIGN KEY (`dept_no`)
    REFERENCES `lv4baza`.`departments` (`dept_no`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dept_manager_employees1`
    FOREIGN KEY (`emp_no`)
    REFERENCES `lv4baza`.`employees` (`emp_no`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



CREATE TABLE IF NOT EXISTS `lv4baza`.`dept_emp` (
  `emp_no` INT NOT NULL,
  `dept_no` INT NULL,
  `from_date` DATETIME NULL,
  `to_date` DATETIME NULL,
  INDEX `fk_dept_emp_departments1_idx` (`dept_no` ASC),
  INDEX `fk_dept_emp_employees1_idx` (`emp_no` ASC),
  CONSTRAINT `fk_dept_emp_departments1`
    FOREIGN KEY (`dept_no`)
    REFERENCES `lv4baza`.`departments` (`dept_no`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dept_emp_employees1`
    FOREIGN KEY (`emp_no`)
    REFERENCES `lv4baza`.`employees` (`emp_no`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
';

 $oConn->query($sQuery);

 ?>