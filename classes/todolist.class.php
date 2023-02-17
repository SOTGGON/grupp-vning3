<?php
class todolist {
    //properties
    private $todo;
    private $db;

    //methods
    function __construct(){
        $this->db = new mysqli("localhost", "root", "", "todolist");

        // Kontroll om filen existerar, om inte då skapa en
        if($this->db->connect_errno > 0){
            die('Fel vid anslutning [' . $this->db->connect_error . ']');
        }
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
            $sql = "INSERT INTO todolist (todo) VALUES ('$this->todo');";

            if($this->db->mysqli_query($sql)){
                return true;
            }
            
        }else{
            return false;
        } 
    }

    // Return and get list 
    public function getTodo() : array{
        $sql = "SELECT * FROM todolist;";

        if($this->db->mysqli_query($sql)){
            return mysqli_fetch_all();
        }
        return $this->todo_list;
    }
}