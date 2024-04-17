<html>
    <head>
        <title>Edit User</title>
        
        <?php require('partials/head.php'); ?>
    </head>
    <body>
        <main hx-boost="true" hx-target="body">

            <a href="index.php" style="display: block; margin-bottom: 12px;">&larr; Back</a>
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
    <form action="/api.php"
        method="PATCH"
        hx-boost="true" 
        hx-swap="innerHTML">
        <input type="hidden" name="id" value="<?php echo $person['id']; ?>">
        <div class="form-group">
            <label>Name</label>
            <input 
                value="<?php echo $person['name']; ?>"
                type="text"
                class="form-control" 
                name="name"
                hx-target="#name-error">
            <div id="name-error" class="error-message"></div>
        </div>
        <div class="form-group">
            <label>Age</label>
            <input 
                value="<?php echo $person['age']; ?>"
                type="text"
                class="form-control" 
                name="age"
                hx-target="#age-error">
            <div id="age-error" class="error-message"></div>
        </div> 
        <button class="btn" type="submit">Save</button>
    </form>
<?php
        }
}
?>
        </main>

        <?php require('partials/script.php'); ?>
    </body>
</html>
