<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Prevent abuse: assign role manually here (e.g., 'user' always)
    $role = 'user'; // or from form: $_POST['role']

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    try {
        $stmt->execute([$username, $password, $role]);
        echo "Registered successfully. <a href='login.php'>Login</a>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<form method="POST">
    <h2>Register</h2>
    Username: <input type="text" name="username" required /><br>
    Password: <input type="password" name="password" required /><br>
    <!-- Uncomment if you want user to pick role (not recommended without validation) -->
    <!-- Role: <select name="role"><option value="user">User</option><option value="admin">Admin</option></select><br> -->
    <input type="submit" value="Register" />
</form>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>