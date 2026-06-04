<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/Project_1/views/CSS/style.css">
    <title>Login</title>
</head>
<body>
    
<?php if(isset($_SESSION["flash_error"])): ?>
    <div class="alert alert-danger" role="alert">
        <?php 
        echo $_SESSION["flash_error"];
        unset($_SESSION["flash_error"]);
        ?>
    </div>
<?php endif; ?>

    <form action="/Project_1/public/login" method="POST" >
    <h1>Login</h1>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <p>Nemáte účet?<a href="register">Zaregistrujte sa!</a></p>
    </form>
</body>
</html>