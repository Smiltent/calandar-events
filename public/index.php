<?php
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
    <header>

    </header>
    <main class="max-w-md mx-auto mt-10 p-6 bg-white rounded-2xl">
        <h1 class="text-2xl font-bold text-center mb-4">
            <?php
                echo $monthName . ' ' . $year;
            ?>
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
                    if ($weekday === 'Saturday' || $weekday === 'Sunday') {
                        // Format Weekend Days
                        $class = "text-red-600";
                    } elseif ($day == $todaysDay) {
                        // Format Today's Day
                        $class = "bg-blue-600 text-white rounded-full";
                    } else {
                        // Default style
                        $class = "";
                    }

                    // Output the day
                    echo "<div class=\"$class\">$day</div>";
                }
            ?>
    </main>
</body>

</html>