<?php
require_once('includes/db_con.php');
session_start();

if (!isset($_SESSION['ID'])) {
  header('Location:login-doctor.php');
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
    <?php 
    if (isset($_SESSION['success'])) {
        $message = $_SESSION['success'];

        echo "<div class=\"alert alert-success\">".$message."</div>";
        $_SESSION['success'] = null;
    }
    if (isset($_SESSION['correct_pass'])) {
        $message = $_SESSION['correct_pass'];

        echo "<div class=\"alert alert-success\">".$message."</div>";
        $_SESSION['correct_pass'] = null;
    }
    ?>
        
        <h3>Registered patients</h3>

        <table class="table">
            <thead>
                <tr>
                    <td>Patient ID</td>
                    <td>First Name</td>
                    <td>Surname</td>
                    <td>Phone Number</td>
                    <td>Email Address</td>
                    <td>Residing City</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_select = "SELECT * FROM patients;";
                $query_process = mysqli_query($DB_connect,$sql_select); 
                
                while ($row = mysqli_fetch_assoc($query_process)) {
                ?>

                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['firstname'] ?></td>
                    <td><?php echo $row['surname'] ?></td>
                    <td><?php echo $row['phone'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['city'] ?></td>
                    <td>
                        <a href="patient-delete.php?user-id=<?php echo $row['id'] ?>" class="btn btn-danger">
                            Delete
                        </a>
                    </td>
                    <td>
                        <a href="patient-update.php?user-id=<?php echo $row['id'] ?>" class="btn btn-primary">
                            Update
                        </a>
                    </td>
                </tr>
                

                <?php } ?>
            </tbody>
        </table>
    </div>

    <footer>
    
    </footer>
</body>
</html>