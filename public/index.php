<?php
    require_once '_database/connect.php';

    $year = date('Y');
    $month = date('n');
    $monthName = date('F');

    $todaysDay = date('j');
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
    <header class="bg-white p-64 shadow-md py-4 flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <h1 class="text-3xl font-bold">Calendar</h1>
        </div>
        <div class="space-x-2">
            <a class="bg-gray-300 px-4 py-2 rounded shadow" href="./register.php">Register</a>
            <a class="bg-blue-500 px-4 py-2 rounded shadow" href="./login.php">Login</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex flex-row mt-10 justify-center space-x-10">
        <div class="p-6 max-w-5xl bg-white rounded-2xl">
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
                            $class .= $isWeekend ? "bg-red-400" : "bg-blue-400 text-white";
                            $class .= " rounded-full";
                        }

                        // Output the day
                        echo "<div class=\"$class\">$day</div>";
                    }
                ?>
            </div>
        </div>
        <div class="p-6 max-w-5xl bg-white rounded-2xl">
            <h1 class="text-2xl font-bold text-center mb-4">
                Upcoming Events
            </h1>
            <div>
                <?php 
                    $balls = false;
                
                    if ($balls) {
                        echo '<ul class="list-disc pl-5">';
                        echo '<li>Event 1: ' . date('Y-m-d', strtotime('+1 week')) . '</li>';
                        echo '<li>Event 2: ' . date('Y-m-d', strtotime('+2 weeks')) . '</li>';
                        echo '</ul>';
                    } else {
                        echo '<p class="text-gray-600">No events scheduled for this month.</p>';
                    }
                ?>
            </div>
        </div>
    </main>

    <!-- Announcements Content -->
    <section class="flex flex-row mt-10 justify-center space-x-10">
        <div class="p-6 max-w-5xl rounded-2xl">
            <h1 class="text-2xl font-bold text-center">
                Announcements
            </h1>
            <div>
                <p class="text-gray-600">Penor</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white p-4 text-center">
        <p class="text-gray-600">© <?= $year; ?> All rights reserved.</p>
        <p class="text-gray-600">Proudly made by Smil</p>
    </footer>
</body>
</html>

<!-- flex w-full max-w-5xl space-x-4 mb-10 bg-white rounded-2xl -->