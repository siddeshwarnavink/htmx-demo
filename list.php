<?php

session_start();

if(!isset($_SESSION['people'])) {
    $_SESSION['people'] = [
        ['id' => 'a', 'name' => 'John doe', 'age' => 23],
        ['id' => 'b', 'name' => 'Kevin', 'age' => 15],
        ['id' => 'c', 'name' => 'Luke', 'age' => 27],
        ['id' => 'd', 'name' => 'Moo', 'age' => 35]
    ];
}

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
            <a hx-get="/edit.php?id=<?php echo $person['id']; ?>&prev=<?php echo $_SERVER['REQUEST_URI']; ?>" hx-target="body" hx-swap="innerHTML">Edit</a>

            <a href="#">Delete</a>
        </td>
    </tr>
<?php }?>
</table>
