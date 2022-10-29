<?php

session_start();

require 'config.php';

if(empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])) {
    echo "<script>
        alert('Please Login first!!!');
        window.location.href = 'login.php';
    </script>";
} else {
    $sql = "DELETE FROM posts WHERE id =" . $_GET['id'];
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();
    if($result) {
        header('Location: index.php');
    } else {
        echo "<script>
                alert('Something Wrong Can't Delete!!!');
            </script>";
    }
}
?>