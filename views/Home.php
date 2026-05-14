<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        foreach ($_POST as $key => $value) {
    
           
            if (str_starts_with($key, "info_")) {
                $id = str_replace("info_", "", $key);
                echo "INFO o userovi: $id";
            }
    
            
            if (str_starts_with($key, "delete_")) {
                $id = str_replace("delete_", "", $key);
                echo "MAZEM usera: $id";
            }
    
            
            if (str_starts_with($key, "update_")) {
                $id = str_replace("update_", "", $key);
                echo "UPDATUJEM usera: $id";
            }
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
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role" required>
                    </div>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Save</button>
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
                    <td>
                        <form action="" method="POST">
                            <button type="submit"  class="btn btn-primary" name="info_<?= $user->getID(); ?>" value="info">Info</button>
                        </form>
                        <form action="" method="POST">
                            <button type="submit" class="btn btn-danger" name="delete_<?= $user->getID(); ?>" value="delete">Delete</button>
                        </form>
                        <form action="" method="POST">
                            <button type="submit" class="btn btn-warning" name="update_<?= $user->getID(); ?>" value="update">Update</button>
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

