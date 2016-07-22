<html>
    <head>
        <title>YouTube Channel Checker</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css">
        <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    </head>
    <body>
        <style>
            body {
                font-family:'Roboto';
                background:#fafafa;
                text-align:center;
            }
        </style>
        <h2>YouTube Channel Checker</h2>
        <form method="post" action="check.php">
            <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" type="text" name="id" id="1">
                <label class="mdl-textfield__label" for="1">YouTube Channel ID</label>
            </div>
            <input type="submit" value="Search" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
        </form>
    </body>
</html>
