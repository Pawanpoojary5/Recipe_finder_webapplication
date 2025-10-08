<!-- create-account.html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Account</title>
  <style>
    body {
        background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
        font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .form-box {
      background: rgba(255,255,255,0.9);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
      animation: fadeIn 0.6s ease-in-out;
      height: 500px;
      width: 400px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #e65100;
    }
    .form-group {
      position: relative;
      margin-bottom: 25px;
    }
    .form-group input {
      width: 100%;
      margin-top:20px;
      padding: 10px 10px 10px 0;
      border: none;
      border-bottom: 2px solid #ff9800;
      background: transparent;
      outline: none;
      transition: 0.3s;
    }
    .form-group label {
      position: absolute;
      top: 10px;
      left: 0;
      pointer-events: none;
      transition: 0.3s ease;
      color: #888;
    }
    .form-group input:focus + label,
    .form-group input:not(:placeholder-shown) + label {
      top: -18px;
      font-size: 14px;
      color: #e65100;
    }
    .form-group input:focus {
      border-color: #e65100;
    }
    button {
      width: 100%;
      margin-top: 30px;
      padding: 20px;
      border: none;
      background: #e65100;
      color: white;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #bf360c;
      transform: scale(1.03);
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(-30px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <div class="form-box">
    <h2>Sign Up</h2>
    <!-- Signup form posts data to register.php -->
    <form method="post" action="signup.php">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Register</button>
      <p>Already have an account? <a href="index.php">Login</a></p>
    </form>
  </div>
    <?php
include 'db.php';

$user = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$pass = $_POST['password'] ?? '';

// Validate input
if (empty($user) || empty($email) || empty($pass)) {
  echo "All fields are required.";
  exit;
}

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $user, $email, $pass);
$stmt->execute();

// Redirect to login
header("Location: login.php");
exit;
?>

</body>

</html>
