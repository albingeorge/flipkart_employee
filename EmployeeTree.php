<?php
include_once("Employee.php");

class EmployeeTree {

    public $ids = array();
    public $employeeArray = array();
    public $tree;

    public function addEmployee($employee)
    {
        $employeeObject = new Employee($employee);
        $this->employeeArray[$employeeObject->employee_id] = $employeeObject;
        $this->ids[$employeeObject->employee_id] = $employeeObject->manager_employee_id;
        // echo "<pre>"; print_r($employeeObject); echo "</pre>";

    }

    public function buildTree(&$current)
    {
        if(sizeof($this->employeeArray) == 0) {

        }
        $subEmployees = $this->findSubEmployeesOfCurrent($current);
        foreach ($subEmployees as $employee) {
            array_push($current->sub_employees, $employee);
            $this->buildTree($employee);
        }
        return;
    }

    public function findCEO()
    {
        foreach ($this->employeeArray as $key => $employee) {
            if($employee->manager_employee_id == null) {
                // Remove the date from the array once it's added to tree
                unset($this->employeeArray[$key]);
                return $employee;
            }
        }
        throw new Exception("A company can't run without a CEO!", 1);
    }

    public function findSubEmployeesOfCurrent($currentEmployee)
    {
        $result = array();
        foreach ($this->employeeArray as $key => $employee) {
            if($employee->manager_employee_id == $currentEmployee->employee_id) {
                unset($this->employeeArray[$key]);
                array_push($result, $employee);
            }
        }
        return $result;
    }
}