<?php
    // ====================
    //   Role Information
    // ====================
    $mysqli = new mysqli(
        getenv('MYSQL_HOST'),
        getenv('MYSQL_USER'),
        getenv('MYSQL_PASSWORD')
    );

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // ------------------------------------------------------------------------

    // ====================
    //   Role Information
    // ====================
    /*
     * Stores a role
     * @param string $roleName Role name
     * @param string $roleDescription Role Description
     * @param int[] $rolePermissionBits Role Permission Bits in an Array
     */
    function storeRole($roleName, $roleDescription, $rolePermissionBits) {

    }

    /*
     * Obtains a role by their name
     * @param string $roleName Role name
     */
    function obtainRoleByName($roleName) {

    }

    // ------------------------------------------------------------------------

    // ====================
    //   User Information
    // ====================
    /*
     * Stores a user. Generating a randomly generating ID, assosiating the account
     * @param string $username Account Holder Username
     * @param string $email Account Holder Email
     * @param string $password Account Holder Password
     * @param string[] $role Account Holder Roles in an Array
     */
    function storeUser($username, $email, $password, $role) {
        // Stores the users username, email and roles in plain.
        // The password gets stored by password_hash()
        // 
    }
    /*
     * Obtains a user by its username
     * @param string $username Account Username
     */
    function obtainUserByUsername($username) {

    }

    /*
     * Obtains all users by their role
     * @param string $username Account Username
     */
    function obtainAllUsersByRoleName($roleName) {

    }

    /*
     * Obtains all users
     * @param string $username Account Username
     */
    function obtainAllUsers() {

    }

    // ------------------------------------------------------------------------

    // ===================
    //  Login Information
    // ===================
    function registerUser() {

    }

    // ------------------------------------------------------------------------

    // ====================
    //  Events Information
    // ====================
    /*
     * Stores an event
     * @param string $eventName Event Name
     * @param unknown $eventDate Event Date
     * @param string $eventCreator Event Creator 
     */
    function storeEvent($eventName, $eventDate, $eventCreator, $eventDescription) {

    }

    /*
     * Obtains an event by their date
     * @param unknown $eventDate Event Date
     */
    function obtainEventByDate($eventDate) {

    }    
    
    function obtainEventByCreator($eventCreator) {

    }

    function obtainAllEvents() {

    }
?> 