<?php
session_start();
if (!isset($_SESSION['username']) && $_SESSION['role'] !== 'admin') {
    header("Location: /login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

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
            <a class="bg-gray-600 px-4 py-2 rounded shadow" href="/index.php">Main</a>
            <a class="bg-blue-500 px-4 py-2 rounded shadow" href="/logout.php">Logout</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-row mt-10 justify-center space-x-10 pb-24">
        <div class="p-8 max-w-5xl bg-white rounded-2xl" style="width: 500px;">
            <h1 class="text-3xl font-bold">Admin Control Panel</h1>
            <p class="text-m pb-4">Hello, <?= htmlspecialchars($_SESSION['username']) ?></p>
            <div class="grid grid-cols-2 gap-2">
                <a href="/admin/events.php" class="bg-gray-600 text-white px-4 py-2 rounded shadow">Manage Events</a>
                <a href="/admin/users.php" class="bg-gray-600 text-white px-4 py-2 rounded shadow">Manage Users</a>
                <a href="#" class="bg-gray-600 text-white px-4 py-2 rounded shadow">Party Mode</a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="fixed bottom-0 w-full bg-white p-4 text-center shadow">
        <p class="text-gray-600">© <?= date('Y') ?> All rights reserved.</p>
        <p class="text-gray-600">Proudly made by Smil</p>
    </footer>
</body>
</html>