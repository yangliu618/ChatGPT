<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Shanghai');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['user_id'];
    $msg = $_POST['msg'];


    // Create a new SQLite database connection
    $db = new SQLite3('db.sqlite');
    // Prepare the INSERT statement
    $stmt = $db->prepare('INSERT INTO main.chat_history (user_id, human, add_time) VALUES (:user_id, :human, :add_time)');

    // Bind the parameters and execute the statement for each row of data
    $row = ['user_id' => $id, 'human' => $msg];

    $stmt->bindValue(':user_id', $row['user_id']);
    $stmt->bindValue(':human', $row['human']);
    $stmt->bindValue(':add_time', date('Y-m-d H:i:s'));
    $stmt->execute();


    //
    // Close the database connection
    // Set the HTTP response header to indicate that the response is JSON
    header('Content-Type: application/json');
    
    // data
    $data = [
        "id" => $db->lastInsertRowID()
    ];

    // Convert the chat history array to JSON and send it as the HTTP response body
    echo json_encode($data);

    $db->close();
}
