<?php
class InputHandler
{
    private $_inputType = "json";
    private $_inputString = "";
    public $input = "";

    function __construct($inputType="json")
    {
        $this->_inputType = $inputType;
        $this->getInput();
    }

    private function getInput()
    {
        switch ($this->_inputType) {
            case 'json':
                $this->_inputString = $this->getInputFromJson();
                break;

            default:
                echo "Invalid Input Format";
                die;
                break;
        }
    }

    public function getInputFromJson()
    {
        $this->_inputString = file_get_contents("input.json");
        $this->input = json_decode($this->_inputString, true);
    }
}