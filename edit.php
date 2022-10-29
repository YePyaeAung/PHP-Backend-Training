<?php
session_start();

require 'config.php';

if(empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])) {
    echo "<script>
        alert('Please Login first!!!');
        window.location.href = 'login.php';
    </script>";
} else {
    if(!empty($_POST)) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $id = $_GET['id'];
    
        $sql = "UPDATE posts SET title = '$title', description = '$description' WHERE id=$id";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute();
    
        if($result) {
            echo "<script>
                alert('Post Updated Successfully!!!');
                window.location.href='index.php';
            </script>";
        }
    }
}



$sql = "SELECT * FROM posts WHERE id=".$_GET['id'];
$stmt = $pdo->prepare($sql);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <form action="edit.php?id=<?= $post['id']; ?>" method="post">
                    <div class="card my-5">
                        <div class="card-header bg-primary">
                            <h1 class="text-center text-white">Create Post Form</h1>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" name="title" class="form-control" value="<?= $post['title']; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" cols="30" rows="5">
                                <?= $post['description']; ?>
                                </textarea>
                            </div>
                            <div class="form-group mb-3">
                                <input type="submit" value="Update" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>