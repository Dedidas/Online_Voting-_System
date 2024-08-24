<?php
session_start();
include("connect.php");

$name = mysqli_real_escape_string($connect, $_POST['name']);
$mobile = mysqli_real_escape_string($connect, $_POST['mobile']);
$password = mysqli_real_escape_string($connect, $_POST['password']);
$c_password = mysqli_real_escape_string($connect, $_POST['c_password']);
$address = mysqli_real_escape_string($connect, $_POST['address']);
$image = uniqid() . '-' . mysqli_real_escape_string($connect, $_FILES['photo']['name']);
$temp_name = $_FILES['photo']['tmp_name'];
$role = mysqli_real_escape_string($connect, $_POST['role']);

if ($password == $c_password) {
    if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        if (move_uploaded_file($temp_name, "../uploads/$image")) {
            $insert = mysqli_query($connect, "INSERT INTO user(name, mobile, password, address, photo, role, status, votes) VALUES('$name', '$mobile', '$password', '$address', '$image', '$role', 0, 0)");
            if ($insert) {
                echo '<script>alert("Registration Successful!"); window.location = "../";</script>';
            } else {
                echo '<script>alert("Database Insert Failed!"); window.location = "../routes/register.html";</script>';
            }
        } else {
            echo '<script>alert("Failed to move uploaded file."); window.location = "../routes/register.html";</script>';
        }
    } else {
        echo '<script>alert("File upload error: ' . $_FILES['photo']['error'] . '"); window.location = "../routes/register.html";</script>';
    }
} else {
    echo '<script>alert("Password and confirm password do not match!"); window.location = "../routes/register.html";</script>';
}
?>