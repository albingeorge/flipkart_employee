<?php

class Employee
{
    public $employee_id;
    public $name;
    public $email;
    public $current_salary;
    public $performance_score;
    public $manager_employee_id;
    public $sub_employees = array();

    function __construct(array $employee)
    {
        $this->employee_id = $employee['employee_id'];
        $this->name = $employee['name'];
        $this->email = $employee['email'];
        $this->current_salary = $employee['current_salary'];
        $this->performance_score = $employee['performance_score'];
        $this->manager_employee_id = $employee['manager_employee_id'];

    }
}