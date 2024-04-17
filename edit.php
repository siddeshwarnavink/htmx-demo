<a hx-get="<?php echo $_GET['prev'] ?? '/list.php'; ?>" hx-target="#users_list" hx-swap="innerHTML">&larr; Back</a>

<?php

session_start(); 

if(isset($_GET['id'])) {
    function findPerson() {
        foreach ($_SESSION['people'] as $p) {
            if($p['id'] == $_GET['id']) {
                return $p;
            }
        }
        return null;
    }

    $person = findPerson();

    if($person != null) {
?>
    <h1><?php echo $person['name']; ?></h1>
<?php
        }
}
?>
