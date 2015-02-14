<?php
// Enable Debug
error_reporting(-1);
ini_set('display_errors', 'On');

// Include all
include_once("InputHandler.php");
include_once("InputFormatter.php");
include_once("Employee.php");
include_once("EmployeeTree.php");


$inputHandler = new InputHandler("json");
$inputFormatter = new InputFormatter($inputHandler->input);
$employeeTree = $inputFormatter->format();
$tree = $employeeTree->tree;
$found = ($emp = $employeeTree->findEmployee($tree, 2)) ? $emp : "Not found";
$employeeTree->addBonus(10000);
// echo "<pre>";print_r($employeeTree->tree); echo "</pre>";
echo "<pre>";print_r($tree);
// $employeeTree->printEmployees();