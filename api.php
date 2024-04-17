<?php

session_start();

header('Content-Type: application/json');

$_SESSION['people'] = [
    ['id' => 'a', 'name' => 'John doe', 'age' => 23]
];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = file_get_contents("php://input");
    $body = json_decode($data, true);
    
    array_push($_SESSION['people'], $body);

    echo json_encode([ 'message' => 'User created', 'user' => $body ]);
} else {
    echo json_encode($_SESSION['people']);
}
