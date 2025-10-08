<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
  echo "Please login to view your wishlist.";
  exit;
}

$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT recipe_name, category FROM wishlist WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>My Wishlist</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 20px; }
    h1 { text-align: center; }
    table { margin: auto; width: 80%; border-collapse: collapse; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.05); border-radius: 10px; }
    th, td { padding: 15px; border-bottom: 1px solid #ddd; }
    th { background-color: #3498db; color: white; }
    .remove-btn {
      background-color: #e74c3c;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
    }
    .remove-btn:hover { background-color: #c0392b; }
    .recipe-link {
      color: #2980b9;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>My Wishlist</h1>
  <h3 style="text-align:center; color: #555;">Saved by: <?= htmlspecialchars($username) ?></h3>

  <table>
    <tr>
      <th>Recipe Name</th>
      <th>Category</th>
      <th>View</th>
      <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr id="row-<?= md5($row['recipe_name'] . $row['category']) ?>">
      <td><?= htmlspecialchars($row['recipe_name']) ?></td>
      <td><?= htmlspecialchars($row['category']) ?></td>
      <td><a class="recipe-link" href="<?= strtolower($row['category']) ?>food.html?dish=<?= urlencode($row['recipe_name']) ?>">View</a></td>
      <td>
        <button class="remove-btn" onclick="removeFromWishlist('<?= addslashes($row['recipe_name']) ?>', '<?= addslashes($row['category']) ?>', 'row-<?= md5($row['recipe_name'] . $row['category']) ?>')">Remove</button>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>

  <script>
    function removeFromWishlist(recipe, category, rowId) {
      if (confirm("Are you sure you want to remove this recipe?")) {
        fetch('remove_wishlist.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'recipe_name=' + encodeURIComponent(recipe) + '&category=' + encodeURIComponent(category)
        })
        .then(response => response.text())
        .then(data => {
          if (data.trim() === "Removed") {
            document.getElementById(rowId).remove();
          } else {
            alert("Failed to remove: " + data);
          }
        });
      }
    }
  </script>
</body>
</html>
