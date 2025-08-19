<?php
    // ============
    //   Database
    // ============
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

    // ------------------------------------------------------------------------

    // ====================
    //   User Information
    // ====================
    /*
     * Stores a user. Generating a randomly generating ID, associated the account
     * @param string $username Account Holder Username
     * @param string $email Account Holder Email
     * @param string $password Account Holder Password
     * @param string[] $role Account Holder Roles in an Array
     * @return int Returns the user ID
     */
    function storeUser($username, $email, $password, $role) {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$username, $email, $password, $role]);

            return $stmt->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());

            return null;
        }
    }

    /*
     * Obtains all users by their role
     * @param string $username Account Username
     * @return array Returns an array of users with the specified role
     */
    function obtainAllUsersByRoleName($roleName) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE role = ?");
        try {
            $stmt->execute([$roleName]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());

            return [];
        }
    }

    /*
     * Obtains all users
     * @return array Returns an array of all users in the database
     */
    function obtainAllUsers() {
        $stmt = $pdo->prepare("SELECT * FROM users");
        try {
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());

            return [];
        }
    }

    // ------------------------------------------------------------------------

    // ====================
    //  Events Information
    // ====================
    /*
     * Stores an event
     * @param string $eventName Event Name
     * @param date $eventDate Event Date
     * @param string $eventCreator Event Creator 
     */
    function storeEvent($eventName, $eventDate, $eventCreator, $eventDescription) {
        $stmt = $pdo->prepare("INSERT INTO events (name, date, creator, description) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$eventName, $eventDate, $eventCreator, $eventDescription]);

            return true;
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());

            return null;
        }
    }

    /*
     * Obtains an event by their date
     * @param unknown $eventDate Event Date
     */
    function obtainEventByDate($eventDate) {
        $stmt = $pdo->prepare("SELECT * FROM events WHERE date = ?");
        try {
            $stmt->execute([$eventDate]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());

            return [];
        }
    }
    
    /*
     * Obtains an event by their ID
     * @param int $eventId Event ID
     */
    function obtainEventByID($eventId) {
        $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
        try {
            $stmt->execute([$eventId]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());

            return [];
        }
    }
    
    /*
     * Obtains an event by their creator
     * @param unknown $eventCreator Event Creators Username or ID
     */
    function obtainEventByCreator($eventCreator) {
        $stmt = $pdo->prepare("SELECT * FROM events WHERE creator = ?");
        try {
            $stmt->execute([$eventCreator]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());

            return [];
        }
    }

    /*
     * Obtains all events 
     */
    function obtainAllEvents() {
        $stmt = $pdo->prepare("SELECT * FROM events");
        try {
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());

            return [];
        }
    }
?>