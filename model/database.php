<?php
$dsn = 'mysql:host=localhost;dbname=video_games_review';
$username = 'reviewer';
$password = 'review2020';
/**Based on Lab5TableCreation script, user will be able to SELECT(see) information from the videogames table
 and SELECT(see), INSERT, UPDATE, and DELETE information from the reviews table */

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('../errors/database_error.php');
    exit();
}
?>
