<?php

session_start();


$_SESSION['people'] = [
    ['id' => 'a', 'name' => 'John doe', 'age' => 23],
    ['id' => 'b', 'name' => 'Kevin', 'age' => 15],
    ['id' => 'c', 'name' => 'Luke', 'age' => 27],
    ['id' => 'd', 'name' => 'Moo', 'age' => 35]
];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    $data = file_get_contents("php://input");
    $body = json_decode($data, true);
    
    array_push($_SESSION['people'], $body);

    echo json_encode([ 'message' => 'User created', 'user' => $body ]);
} else {
    $people = $_SESSION['people'];

    if(isset($_GET['q']) && trim($_GET['q']) != '') {
        $people = array_filter($people, fn($p) => str_contains(strtolower($p['name']), strtolower($_GET['q'])));
    }
?>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th></th>
    </tr>
<?php
    foreach($people as $person) {
?>
    <tr>
        <td><?php echo $person['id'] ?></td>
        <td><?php echo $person['name'] ?></td>
        <td><?php echo $person['age'] ?></td>
        <td class="actions">
            <a href="#">Edit</a>

            <a href="#">Delete</a>
        </td>
    </tr>
<?php }?>
</table>
<?php } ?>
