<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if(isset($_GET['id'])) {
        $_SESSION['people'] = array_filter($_SESSION['people'], fn($p) => $p['id'] != $_GET['id']);
        
        header('Location: /index.php');
        exit;
    }
}
else if($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    $errors = [];

    parse_str(file_get_contents('php://input'), $data);

    if(!isset($data['name']) || trim($data['name']) == '') {
        array_push($errors, ['field' => 'name', 'message' => 'Name is required']);
    } else if (strlen($data['name']) < 3) {
        array_push($errors, ['field' => 'name', 'message' => 'Name must be atleast 3 characters long']);
    }

    if(!isset($data['age']) || trim(strval($data['age'])) == '') {
        array_push($errors, ['field' => 'age', 'message' => 'Age is required']);
    } 

    if(sizeof($errors) > 0) {
        http_response_code(400);
        header('Content-Type: application/json');

        echo json_encode($errors);
        exit;
    } else {
        $_SESSION['people'] = array_map(function($p) use($data) {
            if($p['id'] == $data['id']) {
                return ['id' => $p['id'], 'name' => $data['name'], 'age' => $data['age']];
            }
            return $p;
        }, $_SESSION['people']);  

        header('Location: /index.php');
        exit;
    }
}

