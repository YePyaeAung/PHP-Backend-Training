<?php
session_start();

require 'config.php';

if(empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])) {
    echo "<script>
        alert('Please Login first!!!');
        window.location.href = 'login.php';
    </script>";
} else {
    $sql = "SELECT * FROM posts ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card my-3">
                    <div class="card-header">
                        <h1>All Posts</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <div class="my-3">
                                <a href="create.php" class="btn btn-primary">+ Create New Post</a>
                                <a href="logout.php" class="btn btn-danger float-end">Logout</a>
                            </div>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created_at</th>
                            </tr>
                            <?php 
                            if($posts) {
                                foreach ($posts as $post) {
                            ?>
                            <tr>
                                <td><?= $post['title'] ?></td>
                                <td><?= $post['description'] ?></td>
                                <td><?= date('d/m/Y', strtotime($post['created_at'])) ?></td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
