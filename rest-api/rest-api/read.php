<?php
include_once __DIR__.'/database.php';
include_once __DIR__.'/employee.php';
 
// Get database connection.
$database = new Database();
$db = $database->getConnection();
 
$employee = new Employee($db);
 
// Read employee table.
$results = $employee->readAll();
if(sizeof($results)>0){
 
    // Set response code - 200 OK.
    http_response_code(200);
 
    // Return data in json format.
    echo json_encode($results);
}
else{   // If readAll() failed.
 
    // Set response code - 404 Not found.
    http_response_code(404);
 
    // Return message to user on failure.
    echo json_encode(
        array("message" => "No employee found.")
    );
}
?>