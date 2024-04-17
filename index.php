<html>
    <head>
        <title>Home</title>
        
        <?php require('partials/head.php'); ?>
    </head>
    <body
        hx-get="/list.php"
        hx-trigger="load"
        hx-target="#users_list"
        hx-swap="innerHTML">
        <main hx-boost="true" hx-target="body">
            <h1>People List</h1>

            <input class="search-input"
                autocomplete="off"
                type="search"
                name="q"
                placeholder="Search by name..."
                hx-get="/list.php"
                hx-indicator=".htmx-indicator"
                hx-trigger="input changed delay:500ms, q"
                hx-target="#users_list" />

            <div class="htmx-indicator"> 
                <img src="/img/bars.svg"/> Searching... 
            </div>

            <div id="users_list">
            <?php require('list.php'); ?>
            </div>
        </main>

        <?php require('partials/script.php'); ?>
    </body>
</html>
