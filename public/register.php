<?php
    session_start();
    require __DIR__ . '/../private/db/connect.php';

    $exists = false;

    if (isset($_SESSION['username'])) {
        header("Location: /index.php");
        exit;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $checkStmt->execute([$username]);
        if ($checkStmt->fetchColumn() > 0) {
            $exists = true;
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            try {
                $stmt->execute([$username, $password]);
                header("Location: /login.php");
            } catch (PDOException $e) {
                error_log("Error: " . $e->getMessage());
            }
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
            <h1 class="text-3xl font-bold"><a href="/">Calendar</a></h1>
        </div>
        <div class="space-x-2 text-white">
            <?php
                if (!isset($_SESSION['username'])) {
                    echo '<a class="bg-gray-600 px-4 py-2 rounded shadow" href="/register.php">Register</a>';
                    echo '<a class="bg-blue-500 px-4 py-2 rounded shadow" href="/login.php">Login</a>';
                } else {
                    if ($_SESSION['role'] === 'admin') {
                        echo '<a class="bg-gray-600 px-4 py-2 rounded shadow" href="/admin/index.php">Admin</a>';
                    }
                    echo '<a class="bg-blue-500 px-4 py-2 rounded shadow" href="/logout.php">Logout</a>';
                }
            ?>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex flex-row mt-10 justify-center space-x-10">
        <div class="p-8 max-w-5xl bg-white rounded-2xl" style="width: 500px;">
            <h1 class="text-3xl font-bold">Register</h1>
            <p class="text-sm pb-4">Have an account? <a class="text-blue-600 underline" href="./login.php">Log in</a></p>
            <form action="#" method="post" class="space-y-5">
                <div>
                    <input type="text" name="username" id="username" required 
                        class="rounded-md block w-full px-3 py-2 border border-gray-400 text-black focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Username">
                </div>
                <div>
                    <input type="password" name="password" id="password" required 
                        class="rounded-md block w-full px-3 py-2 border border-gray-400 text-black focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Password">
                </div>
                <div>
                    <input type="password" name="confirm_password" id="confirm_password" required 
                        class="rounded-md block w-full px-3 py-2 border border-gray-400 text-black focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Repeat Password">
                </div>
                <div>
                    <?php
                        if ($exists === true) {
                            echo '<p class="text-red-600 text-center space-y-2">Account already exists</p>';
                        }
                    ?>
                </div>
                <div>
                    <input type="submit" value="Register"
                    class="rounded-md block w-full px-3 py-2 border text-white bg-indigo-600 hover:bg-indigo-700">
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="fixed bottom-0 w-full bg-white p-4 text-center shadow">
        <p class="text-gray-600">© <?= date('Y') ?> All rights reserved.</p>
        <p class="text-gray-600">Proudly made by Smil</p>
    </footer>

    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirm_password").value;
            if (password !== confirmPassword) {
                event.preventDefault();
                alert("Passwords do not match");
            }
        });
    </script>
</body>
</html>