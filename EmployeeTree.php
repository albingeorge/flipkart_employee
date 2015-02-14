<?php
include_once("Employee.php");

class EmployeeTree {

    public $employeeArray = array();
    private $employeeInternal = array();
    public $tree;

    public function addEmployee($employee)
    {
        $employeeObject = new Employee($employee);
        $this->employeeArray[$employeeObject->employee_id] = $employeeObject;
        $this->employeeInternal[$employeeObject->employee_id] = $employeeObject;
    }

    public function buildTree(&$current)
    {
        $subEmployees = $this->findSubEmployeesOfCurrent($current);
        foreach ($subEmployees as $employee) {
            $current->sub_employees[$employee->employee_id] = $employee;
            $this->buildTree($employee);
        }
        return;
    }

    public function setCEO()
    {
        foreach ($this->employeeArray as $key => $employee) {
            if($employee->manager_employee_id == null) {
                // Remove the date from the array once it's added to tree
                unset($this->employeeArray[$key]);
                $this->tree = $employee;
                return $employee;
            }
        }
        throw new Exception("A company can't run without a CEO!", 1);
    }

    public function findSubEmployeesOfCurrent($currentEmployee)
    {
        $result = array();
        if(sizeof($this->employeeArray)) {
            foreach ($this->employeeArray as $key => $employee) {
                if($employee->manager_employee_id == $currentEmployee->employee_id) {
                    unset($this->employeeArray[$key]);
                    array_push($result, $employee);
                }
            }
        }
        return $result;
    }

    public function findEmployee($root, $employeeId)
    {
        if($employeeId == $this->tree->employee_id) {
            return $this->tree;
        }
        if(array_key_exists($employeeId, $root->sub_employees)) {
            return $root->sub_employees[$employeeId];
        } else {
            foreach ($root->sub_employees as $key => $employee) {
                $this->findEmployee($employee, $employeeId);
            }
        }
        return false;
    }

    public function addBonus($bonus)
    {
        $this->recursiveAddBonus($this->tree, $bonus);
    }

    private function recursiveAddBonus(&$root, $bonus)
    {
        if(sizeof($root->sub_employees) == 0) {
            $root->addBonus($bonus);
            $this->updateInternalEmployee($root);
            return;
        } else {
            $total = 0;
            foreach ($root->sub_employees as $employee) {
                $total += $employee->performance_score;
            }
            foreach ($root->sub_employees as $employee) {
                $bonusSplit = ($employee->performance_score/$total)*$bonus;
                $this->recursiveAddBonus($employee, $bonusSplit);
            }
        }
    }

    private function updateInternalEmployee($employee)
    {
        $employee->sub_employees = array();
        $this->employeeInternal[$employee->employee_id] = $employee;
    }

    public function printEmployees()
    {
        echo "<pre>";print_r($this->employeeInternal); echo "</pre>";
    }
}