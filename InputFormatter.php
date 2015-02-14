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
        $this->format();
    }

    public function format()
    {
        foreach ($this->_input['employees'] as $employee) {
            $this->employeeTree->addEmployee($employee);
        }

        $root = $this->employeeTree->findCEO();
        $this->employeeTree->buildTree($root);
        echo "<pre>"; print_r($root);
    }
}