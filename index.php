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
$tree = $inputFormatter->format();

echo "<pre>";print_r($tree);