<?php
    session_start();
    require '_database/connect.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        try {
            $stmt->execute([$username]);
            $user = $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
        }

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: /index.php");
            exit;
        } else {
            echo "Unknown Account";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main | Calendar</title>

    <!-- CSS -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./src/style.css">
</head>
<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-white p-64 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <h1 class="text-3xl font-bold"><a href="./">Calendar</a></h1>
        </div>
        <div class="space-x-2 text-white">
            <a class="bg-gray-600 px-4 py-2 rounded shadow" href="./register.php">Register</a>
            <a class="bg-blue-500 px-4 py-2 rounded shadow" href="./login.php">Login</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex flex-row mt-10 justify-center space-x-10">
        <div class="p-6 max-w-5xl bg-white rounded-2xl">
            <form action="#" method="post" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">
                        Username
                    </label>
                    <input type="text" name="username" id="username" required 
                        class="rounded-md block w-full px-3 py-2 border border-gray-400 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Enter your username">
        
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <input type="password" name="password" id="password" required 
                        class="rounded-md block w-full px-3 py-2 border border-gray-400 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Enter your password">
                </div>
                <div>
                    <input type="submit" value="Sign in"
                    class="rounded-md block w-full px-3 py-2 border text-white bg-indigo-600 hover:bg-indigo-700">
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white p-4 text-center">
        <p class="text-gray-600">© <?= date('Y') ?> All rights reserved.</p>
        <p class="text-gray-600">Proudly made by Smil</p>
    </footer>
</body>
</html>