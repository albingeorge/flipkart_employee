<?php

include_once("EmployeeTree.php");

class InputFormatter
{

    private $_input;
    private $employeeTree;
    function __construct($input)
    {
        $this->employeeTree = new EmployeeTree();
        $this->_input = $input;
    }

    public function format()
    {
        foreach ($this->_input['employees'] as $employee) {
            $this->employeeTree->addEmployee($employee);
        }
        $this->employeeTree->setCEO();
        $this->employeeTree->buildTree($this->employeeTree->tree);
        // $this->employeeTree->printEmployees();
        return $this->employeeTree;
    }
}