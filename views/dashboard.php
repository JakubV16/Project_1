<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/Project_1/views/CSS/style-dash.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <h2><?php $_SESSION["username"];?></h2>
        <a href="/Project_1/public/logout">Logout</a>
    </div>
</body>
</html>