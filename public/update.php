<?php
require_once __DIR__ . "/../vendor/autoload.php";

use App\Core\Database;
use App\Repositories\UserRepository;
use App\Models\User;

$db = new Database();
$pdo = $db->getConnection();
$userRepo = new UserRepository($pdo);


$id = $_POST["id"] ?? null;


$users = $userRepo->findAll();
$userToEdit = null;

foreach ($users as $u) {
    if ($u->getId() == $id) {
        $userToEdit = $u;
        break;
    }
}


if (isset($_POST["update_save"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $userToEdit->setUsername($username);

    if (!empty($password)) {
        $userToEdit->setPassword($password, false);
    }

    $userRepo->update($userToEdit);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Update User</title>
</head>
<body>
<div class="container mt-4">

    <h3>Update User</h3>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $userToEdit->getId() ?>">

        <div class="mb-3">
            <label> New Username</label>
            <input type="text" name="username" class="form-control" value="<?= $userToEdit->getUsername() ?>" required>
        </div>

        <div class="mb-3">
            <label>New Password </label>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>

        <button type="submit" name="update_save" class="btn btn-success">Save</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>

</div>
</body>
</html>
