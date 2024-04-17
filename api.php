<?php

session_start();


$_SESSION['people'] = [
    ['id' => 'a', 'name' => 'John doe', 'age' => 23]
];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    $data = file_get_contents("php://input");
    $body = json_decode($data, true);
    
    array_push($_SESSION['people'], $body);

    echo json_encode([ 'message' => 'User created', 'user' => $body ]);
} else {
    foreach($_SESSION['people'] as $person) {
?>
<div class="card">
    <h3><?php echo $person['name'] ?></h3>
    <p>Age: <?php echo $person['age'] ?></p>
</div>
<?php }}?>
