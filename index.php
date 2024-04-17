<html>
    <head>
        <title>HTMX Demo</title>

        <script src="https://unpkg.com/htmx.org@1.9.11"></script>
        <link rel="stylesheet" href="/style.css" />
    </head>
    <body
        hx-get="/list.php"
        hx-trigger="load"
        hx-target="#users_list"
        hx-swap="innerHTML">
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
    </body>
</html>
