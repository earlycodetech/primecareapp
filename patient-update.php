<?php
require_once('includes/db_con.php');
session_start();

//identify patient
$user = $_GET['user-id'];

//select query for specific patient
$sql_select = "SELECT * FROM patients WHERE id='$user';";
$user_query = mysqli_query($DB_connect,$sql_select);

//fetch needed rows
$user_row = mysqli_fetch_assoc($user_query);
$fname = $user_row['firstname'];
$sname = $user_row['surname'];
$phone = $user_row['phone'];
$email = $user_row['email'];
$city = $user_row['city'];

//update records
if (isset($_POST['patient-update'])) {
    $Firstname = $_POST['first_name'];
    $Surname = $_POST['surname'];
    $Phone = $_POST['phone'];
    $Email = $_POST['email'];
    $City = $_POST['city'];

    $sql_update = "UPDATE patients SET firstname='$Firstname',surname='$Surname',
    phone='$Phone',email='$Email',city='$City' WHERE id='$user'";

    if (mysqli_query($DB_connect,$sql_update)) {
        $_SESSION['success'] = 'Update record was successful';
        header('Location:admin.php');
    }
    else {
        $_SESSION['error'] = 'Update record failed';
        header('Location:admin.php');
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
        <h3>Update patient record for patient ID 2</h3>
        <div class="alert alert-secondary">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="first_name">First name</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo $fname?>">
                </div>
                <div class="mb-3">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" class="form-control" value="<?php echo $sname?>">
                </div>
                <div class="mb-3">
                    <label for="phone">Phone number</label>
                    <input type="tel" name="phone" class="form-control" value="<?php echo $phone?>">
                </div>
                <div class="mb-3">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email?>">
                </div>
                <div class="mb-3">
                    <label for="city">Residing city</label>
                    <input type="text" name="city" class="form-control" value="<?php echo $city?>">
                </div>
                <div class="mb-3">
                    <button type="submit" name="patient-update" class="btn btn-lg btn-dark">Update Patient Record</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>