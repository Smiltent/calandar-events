<?php
    // =================
    //   Database Init
    // =================
    $host = getenv('MYSQL_HOST');
    $dbname = getenv('MYSQL_DATABASE');
    $user = getenv('MYSQL_USER');
    $pass = getenv('MYSQL_PASSWORD');

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
    
    // ===============
    //   USERS TABLE
    // ===============
    try {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                role VARCHAR(255) NOT NULL DEFAULT 'user',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");
    } catch (PDOException $e) {
        error_log("Error creating users table: " . $e->getMessage());
    }

    // ================
    //   EVENTS TABLE
    // ================
    try {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS events (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                location VARCHAR(255) NOT NULL,
                time DATETIME NOT NULL
            )
        ");
    } catch (PDOException $e) {
        error_log("Error creating events table: " . $e->getMessage());
    }

    // =============================================================
    //   INTERESTED IN EVENTS TABLE
    //   Stole this off the interwebs, don't ask me how this works
    // =============================================================
    try {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS event_int (
                event_id INT,
                user_id INT,
                rating TEXT,
                PRIMARY KEY (event_id, user_id),
                FOREIGN KEY (event_id) REFERENCES events(id),
                FOREIGN KEY (user_id) REFERENCES users(id)
            )
        ");
    } catch (PDOException $e) {
        error_log("Error creating events table: " . $e->getMessage());
    }
?>