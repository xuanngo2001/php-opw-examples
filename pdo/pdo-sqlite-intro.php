<?php
/**
 * From https://openwritings.net/node/788
 * Description: Show how to use PDO on SQLite.
 */
 
 
// Create and connect to SQLite database file.
// --------------------------------
$db_file = new PDO('sqlite:'.__DIR__.'/mytest.db');


// Create employees table.
$db_file->exec("CREATE TABLE IF NOT EXISTS employees(
                    id INTEGER PRIMARY KEY, 
                    name TEXT,
                    role TEXT)");

// Insert data.
// --------------------------------
// Data to insert.
$data = array(
                array('name' => 'joe', 'role' => 'CEO'),
                array('name' => 'Amy', 'role' => 'CFO'),
            );
            
// Prepare INSERT statement.
$insert = "INSERT INTO employees (name, role) VALUES (:name, :role)";
$stmt = $db_file->prepare($insert);

// Insert data in database.
foreach($data as $row) {
    
    // Bind parameters to statement variables.
    //  List of data type: https://www.php.net/manual/en/pdo.constants.php
    $stmt->bindParam(':name', $row['name'], PDO::PARAM_STR);
    $stmt->bindParam(':role', $row['role'], PDO::PARAM_STR);
    
    // Execute statement.
    $stmt->execute();
}

// Update data.
// --------------------------------
// Prepare INSERT statement.
$update = "Update employees SET name=? WHERE name=?";
$stmt = $db_file->prepare($update);

// Execute statement.
$stmt->execute(array('NewJoe', 'joe'));

// Delete data.
// --------------------------------
// Prepare DELETE statement.
$delete = "DELETE FROM employees WHERE id > ?";
$stmt = $db_file->prepare($delete);

// Execute statement.
$stmt->execute(array(3));

// Fetch all data.
// --------------------------------
// Prepare SELECT statement.
$select = "SELECT * FROM employees WHERE id >= ? AND id <= ?";
$stmt = $db_file->prepare($select);

// Execute statement.
$stmt->execute(array(1, 3)); // ID between 1 and 3.

// Get the results.
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $row) {
    print_r($row);
}
?>
