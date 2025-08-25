<?php
    session_start();
    require __DIR__ . '/../private/db/connect.php';

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$event) {
            header("Location: /index.php");
            exit;
        }
    } else {
        header("Location: /index.php");
    }

    if (isset($_SESSION['username'])) {
        // header("Location: /index.php");
        // exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template | Calendar</title>

    <!-- CSS -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/style.css">
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
            <h1 class="text-3xl font-bold">Content</h1>
        </div>
    </main>

    <!-- Footer -->
    <footer class="fixed bottom-0 w-full bg-white p-4 text-center shadow">
        <p class="text-gray-600">© <?= date('Y') ?> All rights reserved.</p>
        <p class="text-gray-600">Proudly made by Smil</p>
    </footer>
</body>
</html>