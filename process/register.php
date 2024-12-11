<?php

include 'conn.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if(empty($name) || empty($email) || empty($phone)){
    echo "<script>alert('Please fill in all fields');</script>";
    echo "<script>window.location.href = '../registration.php';</script>";
}

// Check if email already exists
$check_email = "SELECT * FROM registration WHERE email = '$email'";
$result = mysqli_query($conn, $check_email);
    
if(mysqli_num_rows($result) > 0) {
    echo "<script>
    alert('Email already exists!');
    window.location.href='../registration.php';
    </script>";
    exit();
}

if(isset($_POST['register'])){
    $sql = "INSERT INTO registration (full_name, email, phone) VALUES ('$name', '$email', '$phone')";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Registration successful');</script>";
        echo "<script>window.location.href = '../registration.php';</script>";
    }else{
        echo "<script>alert('Registration failed');</script>";
        echo "<script>window.location.href = '../registration.php';</script>";
    }
}
$conn->close();

?>