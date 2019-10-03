<?php
class Employee{
 
    private $conn;
    
    // Object properties.
    public $id;
    public $name;
    public $role;
 
    // Constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
    
    // Return all employees.
    function readAll(){
 
        // Query to insert record.
        $query = "SELECT * FROM employee";
 
        // Prepare query.
        $stmt = $this->conn->prepare($query);
 
        // Execute query.
        if($stmt->execute()){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        else{
            print_r($stmt->errorInfo());
            return array();
        }
    }
    
    // Create an employee.
    function create(){
     
        // Query to insert record.
        $query = "INSERT INTO employee(name, role) VALUES(:name, :role)";

        // Prepare query.
        $stmt = $this->conn->prepare($query);
     
        // Sanitize inputs.
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->role=htmlspecialchars(strip_tags($this->role));
     
        // Bind values.
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":role", $this->role);

        // Execute query.
        if($stmt->execute()){
            return true;
        }
        else{
            print_r($stmt->errorInfo());
            return false;
        }
    }
}

?>