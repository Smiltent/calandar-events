<?php
    require_once __DIR__ . '/../private/db/connect.php';
    session_start();

    $year = date('Y');
    $month = date('n');
    $monthName = date('F');

    $todaysDay = date('j');

    $maxLength = 16;

    function shortenText($text) {
        if (mb_strlen($text) > 16) {
            return mb_substr($text, 0, 16 - 3) . '...';
        }
        return $text;
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
    <main class="flex-grow flex flex-row mt-10 justify-center space-x-10 pb-24">
        <div class="p-6 max-w-5xl bg-white rounded-2xl" style="width:340px;">
            <h1 class="text-2xl font-bold text-center mb-4">
                <?= $monthName . ' ' . $year; ?>
            </h1>
            <div class="grid grid-cols-7 gap-2 text-center font-medium text-gray-700">
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div class="text-red-600">Sat</div>
                <div class="text-red-600">Sun</div>
            </div>
            <div class="grid grid-cols-7 gap-2 text-center mt-2">
                <?php
                    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                    // Day's map, that uses the weekday as a key. Used for padding.
                    $dayMap = [
                        'Monday' => 0,
                        'Tuesday' => 1,
                        'Wednesday' => 2,
                        'Thursday' => 3,
                        'Friday' => 4,
                        'Saturday' => 5,
                        'Sunday' => 6
                    ];

                    $alreadyRun = false;

                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                        $weekday = date('l', strtotime($dateStr));

                        // Runs only ONCE! This adds padding (div), before the first day of the month
                        if (!$alreadyRun && isset($dayMap[$weekday])) {
                            for ($i = 0; $i < $dayMap[$weekday]; $i++) {
                                echo "<div></div>";
                            }
                            $alreadyRun = true;
                        }

                        // Output with styling
                        $class = "";

                        $isWeekend = ($weekday === 'Saturday' || $weekday === 'Sunday');
                        $isTodayToday = ($day == $todaysDay);

                        if ($isWeekend) {
                            $class .= "text-red-700 ";
                        }

                        if ($isTodayToday) {
                            $class .= $isWeekend ? "bg-red-400" : "bg-blue-500 text-white";
                            $class .= " rounded-full";
                        }

                        // Output the day
                        echo "<div class=\"$class\">$day</div>";
                    }
                ?>
            </div>
        </div>
        <div class="p-6 max-w-5xl bg-white rounded-2xl" style="width:340px;">
            <h1 class="text-2xl font-bold text-center mb-4">
                Upcoming Events
            </h1>
            <div class="text-center" style="max-height: 185px; overflow-y: auto;">
                <?php
                    $now = date('Y-m-d H:i:s');
                    $stmt = $pdo->prepare("SELECT title, start_time FROM events WHERE YEAR(start_time) = ? AND MONTH(start_time) = ? AND start_time >= ? ORDER BY start_time ASC");
                    $stmt->execute([$year, $month, $now]);
                    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($events) > 0) {
                        foreach ($events as $event) {
                            echo "<div class=\"flex text-white bg-blue-500 p-2 px-4 rounded-2xl justify-between mb-2\">";
                            echo "<p class=\"text-left\">" . htmlspecialchars(shortenText($event['title'])) . "</p>";
                            echo "<p class=\"text-right\">" . date('jS F', strtotime($event['start_time'])) . "</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p class=\"text-gray-600\">No events scheduled for this month.</p>";
                    }
                ?>
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