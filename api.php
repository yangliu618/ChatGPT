<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create a new SQLite database connection
    $db = new SQLite3('db.sqlite');

    // Get the user ID from the request data
    $user_id = $_POST['user_id'];
    // Prepare and execute a SELECT statement to retrieve the chat history data
    $stmt = $db->prepare('SELECT human, ai FROM chat_history WHERE user_id = :user_id ORDER BY id ASC');
    $stmt->bindValue(':user_id', $user_id, SQLITE3_TEXT);
    $result = $stmt->execute();

    // Fetch the results and store them in an array
    $chat_history = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $row['ai'] = nl2br($row['ai']);
        $chat_history[] = $row;
    }

    // Close the database connection
    $db->close();

    // Set the HTTP response header to indicate that the response is JSON
    header('Content-Type: application/json');

    // Convert the chat history array to JSON and send it as the HTTP response body
    echo json_encode($chat_history);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the user ID to delete from the request body
    $user_id = $_GET['user'];
    $act = $_GET['act'] ?? '';
    if ($act == 'delTopic') {
        $db = new SQLite3('db.sqlite');
        $stmt = $db->prepare('DELETE FROM chat_history WHERE user_id = :user_id');
        $stmt->bindValue(':user_id', $user_id, SQLITE3_TEXT);
        $result = $stmt->execute();
        $db->close();
    }
    http_response_code(204); // No Content
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $act = $_GET['act'] ?? '';
    if ($act == 'listChatHistory') {
        listChatHistory();
    }
}

function listChatHistory(){
    $db = new SQLite3('db.sqlite');
    $user_id = $_POST['user_id'] ?? '';
    // Prepare and execute a SELECT statement to retrieve the chat history data
    $stmt = $db->prepare('SELECT * FROM chat_history WHERE id IN(SELECT MIN(id) FROM chat_history group by user_id) ORDER BY id DESC');
    $result = $stmt->execute();
    $chat_history = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $row['human'] = mb_substr($row['human'], 0, 70);
        $chat_history[] = $row;
    }
    $db->close();
    header('Content-Type: application/json');
    echo json_encode($chat_history);
}