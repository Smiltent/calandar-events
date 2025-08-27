<?php
    session_start();
    require __DIR__ . '/../../../private/db/connect.php';

    if (!isset($_SESSION['username']) && $_SESSION['role'] !== 'admin') {
        header("Location: /login.php");
        exit;
    }

    // TODO: Make checks to make sure that the start time is not in the past, and the end time is not in the past
    // TODO: Make validation checks, to tell the user what errors have happened - the same to tell the user it was created

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        $start_time = date('Y-m-d H:i:s', strtotime($date . ' ' . $time));

        $stmt = $pdo->prepare("INSERT INTO events (title, description, location, time) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$title, $description, $location, $start_time]);
            header("Location: /admin/events.php");
            exit;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an event</title>

    <!-- CSS -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/style.css">
</head>
<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-white p-64 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <h1 class="text-3xl font-bold"><a href="/admin/index.php">Calendar | Admin</a></h1>
        </div>
        <div class="space-x-2 text-white">
            <a class="bg-gray-600 px-4 py-2 rounded shadow" href="/index.php">Main</a>
            <a class="bg-blue-500 px-4 py-2 rounded shadow" href="/logout.php">Logout</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-row mt-10 justify-center space-x-10 pb-24">
        <div class="p-8 max-w-5xl bg-white rounded-2xl" style="width: 600px;">
            <h1 class="text-3xl font-bold">Create</h1>
            <p class="text-m pb-4">Create an event with specific details</p>
            <form action="#" method="post" class="space-y-5">
                <div>
                    <input type="text" name="title" id="title" required 
                        class="rounded-md block w-full px-3 py-2 border border-gray-400 text-black focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Title">
                </div>
                <div>
                    <textarea name="description" id="description"
                        class="rounded-md block w-full px-3 py-2 border border-gray-400 text-black focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 resize-y"
                        placeholder="Description" rows="3"></textarea>
                </div>
                <div>
                    <div class="flex space-x-5 w-full">
                        <div>
                            <p class="">Start time</p>
                            <input type="datetime-local" name="start_time" id="start_time" required 
                                class="rounded-md block w-full px-3 py-2 border border-gray-400 text-black focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                min="<?= date('Y-m-d\TH:i') ?>">
                        </div>
                        <div>
                            <p>End time (optional)</p>
                            <input type="datetime-local" name="end_time" id="end_time" 
                                class="rounded-md block w-full px-3 py-2 border border-gray-400 text-black focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                min="<?= date('Y-m-d\TH:i') ?>">
                        </div>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Create Event"
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
</body>
</html>