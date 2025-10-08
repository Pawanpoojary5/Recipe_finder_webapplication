<?php
session_start();
include 'db.php';

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
  echo "Please login to save to wishlist.";
  exit;
}

$username = $_SESSION['username'];
$recipe = $_POST['recipe_name'] ?? '';
$category = $_POST['category'] ?? '';

// Check required fields
if (empty($recipe) || empty($category)) {
  echo "Missing data.";
  exit;
}

// Check if recipe already in wishlist
$stmt = $conn->prepare("SELECT * FROM wishlist WHERE username=? AND recipe_name=?");
$stmt->bind_param("ss", $username, $recipe);
$stmt->execute();
$result = $stmt->get_result();

// Insert if not already saved
if ($result->num_rows === 0) {
  $insert = $conn->prepare("INSERT INTO wishlist (username, recipe_name, category) VALUES (?, ?, ?)");
  $insert->bind_param("sss", $username, $recipe, $category);
  $insert->execute();
  echo "Added to wishlist!";
} else {
  echo "Already in wishlist.";
}
?>

