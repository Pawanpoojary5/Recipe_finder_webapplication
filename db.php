<!-- File: db.php (Database connection) -->
<?php
$conn = new mysqli("localhost", "root", "", "recipe_finder");
// Terminate on connection error
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
?>
