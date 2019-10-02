<?php
// Required headers.
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, 
            Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once __DIR__.'/database.php';
include_once __DIR__.'/employee.php';
 
// Get database connection.
$database = new Database();
$db = $database->getConnection();
 
$employee = new Employee($db);
 
// Get posted JSON data.
$data = json_decode(file_get_contents("php://input"));
 
// Set employee property values
$employee->name = $data->name;
$employee->role = $data->role;
 
// Create the employee
if($employee->create()){
 
    // Set response code - 201 created.
    http_response_code(201);
 
    // Return message to user on success.
    echo json_encode(array("message" => "Employee was created."));
}
else{ // If create employee failed.
 
    // Set response code - 503 service unavailable.
    http_response_code(503);
 
    // Return message to user on failure.
    echo json_encode(array("message" => "Unable to create employee."));
}
?>