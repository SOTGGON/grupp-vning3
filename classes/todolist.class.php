<?php
class todolist {
    //properties
    private $todo;
    private $todo_list = array();

    //methods
    function __construct(){
        // Kontroll om filen existerar, om inte dåå skapa en
        if(!file_exists("todolist.json")){
            file_put_contents("todolist.json", "[]");
        }
        
        // Läser in fil
        $file = file_get_contents("todolist.json");

        // Omvandla till array
        $this->todo_list = json_decode($file, true);
    }

    // Set todo
    public function setTodo(string $todo) : bool{
        // Kontroll om textstränger är tom och längre än 5 tecken
        if(strlen($todo) >= 5){
            $this->todo = $todo;
            $this->saveTodo();
            return true;
        }

        return false;
    }

    // Save list
    public function saveTodo() : bool{
        // Kontroll om todo isset
        if(isset($this->todo)){
            array_push($this->todo_list, $this->todo);

            // Omvandla array till json format
            $jsonData = json_encode($this->todo_list, JSON_PRETTY_PRINT);

            // Lägga till den till json filen
            file_put_contents("todolist.json", $jsonData);
            return true;
        }else{
            return false;
        } 
    }

    // Return and get list 
    public function getTodo() : array{
        return $this->todo_list;
    }
}