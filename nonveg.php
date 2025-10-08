<?php
$conn = new mysqli("localhost", "root", "", "recipe_finder");

$dish = $_GET['dish'];
$result = $conn->query("SELECT * FROM recipes WHERE LOWER(REPLACE(name, ' ', '')) = '$dish'");
$data = $result->fetch_assoc();

if (!$data) {
  echo "Recipe not found.";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head><title><?= $data['name'] ?></title></head>
<body>
  <h1><?= $data['name'] ?></h1>
  <img src="<?= $data['image_path'] ?>" width="300">
  <p><?= nl2br($data['description']) ?></p>
</body>
</html>
