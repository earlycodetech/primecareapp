<?php
require_once('includes/db_con.php');
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM patients WHERE email= ?";
    $stmt = mysqli_stmt_init($DB_connect);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,'s',$email);
    mysqli_stmt_execute($stmt);

    if ($result = mysqli_stmt_get_result($stmt)) {
        $row = mysqli_fetch_assoc($result);
        $hashedpassword = $row['password'];

        if (password_verify($password,$hashedpassword)) {
            $Firstname = $row['firstname'];
            $_SESSION['ID'] = $row['id'];
            $_SESSION['SURNAME'] = $row['surname'];

            $_SESSION['correct_pass'] = "Welcome, $Firstname";
            header('Location:admin.php');
        }
        else {
            $_SESSION['incorrect_pass'] = 'Incorrect password';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primecare | Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/bootstrap.min.js" defer></script>
</head>
<body>
    <?php include('modules/nav.php'); ?>

    <div class="container">
        <div class="card card-custom">
            <div class="card-header">
                <h3>Signin to an existing account</h3>
                <?php 
                if (isset($_SESSION['incorrect_pass'])) {
                    $message = $_SESSION['incorrect_pass'];

                    echo "<div class=\"alert alert-danger\">".$message."</div>";
                    $_SESSION['success'] = null;
                }
                ?>
            </div>
            <div class="card-body">
                <form action="login-doctor.php" method="POST">
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="email address">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="login" class="btn btn-primary btn-lg">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
    
    </footer>
</body>
</html>