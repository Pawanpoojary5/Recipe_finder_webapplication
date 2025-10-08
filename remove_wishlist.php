<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
  echo "Not logged in";
  exit;
}

$username = $_SESSION['username'];
$recipe = $_POST['recipe_name'] ?? '';
$category = $_POST['category'] ?? '';

if (empty($recipe) || empty($category)) {
  echo "Missing data";
  exit;
}

$stmt = $conn->prepare("DELETE FROM wishlist WHERE username = ? AND recipe_name = ? AND category = ?");
$stmt->bind_param("sss", $username, $recipe, $category);
if ($stmt->execute()) {
  echo "Removed";
} else {
  echo "Error";
}
?>
