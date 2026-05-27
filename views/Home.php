<?php
  require_once __DIR__. "/../vendor/autoload.php"; 
 
  use App\Core\Database;
  use App\Repositories\UserRepository;
  use App\Models\User;

  $db = new Database();
  $pdo = $db->getConnection();
  $userRepo = new UserRepository($pdo);
  //UPLOAD
  if (isset($_POST["save"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = new User($username, $password, "user", false);
    $userRepo->save($user);

    header("Location: Home.php");
    exit;
  }
  //DELETE
  foreach ($_POST as $key => $value) {
        if (str_starts_with($key, "delete_")) {
            $id = str_replace("delete_", "", $key);
            $userRepo->delete((int)$id);
    
            header("Location: Home.php");
            exit;
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>USERS DATA</title>
</head>
<body>
<div class="container">
    <div class="wrapper p-3">
        <form action="" method="POST">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="col">
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>



    <h2>Users List</h2>
    <div class="container">
    <table class="table table-bordered table-striped ">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Created_at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user):?>
                <tr>
                    <td><?= $user ->getID();?></td>
                    <td><?= $user ->getUsername();?></td>
                    <td><?= $user ->getRole();?></td>
                    <td><?= $user ->getCreatedAt();?></td>
                    <td class="d-flex gap-2">
                        <form action="" method="POST">
                            <button type="submit"  class="btn btn-primary" name="info_<?= $user->getID(); ?>" value="info">Info</button>
                        </form>
                        <form action="" method="POST">
                            <button type="submit" class="btn btn-danger" name="delete_<?= $user->getID(); ?>" value="delete">Delete</button>
                        </form>
                        <form action="update.php
                        " method="POST">
                            <input type="hidden" name="id" value="<?= $user->getID(); ?>">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    </div>
</div>
</body>
</html>

