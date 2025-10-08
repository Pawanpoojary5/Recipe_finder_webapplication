<?php
session_start();
include 'db.php';

// Fetch all users and wishlists from the database
$users = $conn->query("SELECT * FROM users");
$wishlists = $conn->query("SELECT * FROM wishlist");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Family Treasure</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f7f9fb;
      margin: 0;
      padding: 40px;
    }
    h1 {
      text-align: center;
      color: #333;
    }
    h2 {
      color: #2c3e50;
      margin-top: 40px;
      border-bottom: 2px solid #ddd;
      padding-bottom: 10px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      background: white;
      border-radius: 8px;
      overflow: hidden;
    }
    th, td {
      padding: 12px 16px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }
    th {
      background-color: #2980b9;
      color: white;
      font-weight: normal;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    tr:hover {
      background-color: #f0f8ff;
    }
    .container {
      max-width: 1000px;
      margin: auto;
    }
    .back-link {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      background-color: #3498db;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      transition: background-color 0.3s ease;
    }
    .back-link:hover {
      background-color: #2c80b4;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Admin Panel</h1>

    <h2>Registered Users</h2>
    <table>
      <tr><th>ID</th><th>Username</th><th>Email</th></tr>
      <?php while($u = $users->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($u['id']) ?></td>
        <td><?= htmlspecialchars($u['username']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
      </tr>
      <?php endwhile; ?>
    </table>

    <h2>Wishlists</h2>
    <table>
      <tr><th>User</th><th>Recipe</th><th>Category</th></tr>
      <?php while($w = $wishlists->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($w['username']) ?></td>
        <td><?= htmlspecialchars($w['recipe_name']) ?></td>
        <td><?= htmlspecialchars($w['category']) ?></td>
      </tr>
      <?php endwhile; ?>
    </table>

    <a href="nonveg.html" class="back-link">← Back to Dashboard</a>
  </div>
</body>
</html>
