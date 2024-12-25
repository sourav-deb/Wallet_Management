<?php

// include required phpmailer files
include './../../PHPMailer/PHPMailer.php';
include './../../PHPMailer/SMTP.php';
include './../../PHPMailer/Exception.php';
// define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../../process/conn.php';
include '../../auth.php';

// Set header to return JSON response
// header('Content-Type: application/json');


if (isset($_POST['assign_role'])) {
    $id = $_POST['id'];
    $role = $_POST['assigned_to'] ?? '';
    $retailer = $_POST['retailer'] ?? '';
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $commission_type = $_POST['commission_type'] ?? '';
    $commission_value = $_POST['commission_value'] ?? '';

    // echo $id . " " . $role . " " . $retailer;

    date_default_timezone_set('Asia/Kolkata');
    $created_at = date(format: 'Y-m-d H:i:s');

    if (empty($id) || empty($role)) {
        echo "Please fill all the fields";
        echo "<script>window.location.href = '../pending.php?error=missing_fields';</script>";
        exit;
    }

    if ($role == 'user') {
        if (empty($retailer)) {
            echo "Please select a retailer";
            echo "<script>window.location.href = '../new_registrations.php?error=missing_retailer';</script>";
            exit;
        } else {
            echo "Retailer selected";
            // Update
            $query = "UPDATE registration SET status = 'Approved', role = '$role' WHERE id = '$id'";
            mysqli_query($conn, $query);

            // $query2 = "INSERT INTO user (user_id, user_name, email, phone, retailer, retailer_id, commission_type, commission_value, created_at) VALUES ('$role.$id', '$full_name', '$email', '$phone', '$retailer', '$retailer', '$commission_type', '$commission_value', '$created_at')";
            // mysqli_query($conn, $query2);

            addProfile($conn, $id, $full_name, $role, $email, $phone, 'retailer', $retailer, $retailer_id, $commission_type, $commission_value, 'Active', $created_at);
            addCustomer($conn, $id, $full_name, $role, $email, $phone, 'retailer', $retailer, $retailer_id, $commission_type, $commission_value, 'Active', $created_at);

            echo "Generated Password: " . generatePassword();
            $password = generatePassword();
            mailtoCustomer('Your account has been approved and you are now a user of our system. You can now login to your account and start using our services.',  $password);

            echo "<script>window.location.href = '../pending.php?success=role_assigned';</script>";
        }
    } elseif ($role == 'retailer') {
        echo "Retailer selected";
        // Update

        $query = "UPDATE registration SET status = 'Approved', role = '$role' WHERE id = '$id'";
        mysqli_query($conn, $query);

        // $query2 = "INSERT INTO retailer (retailer_id, retailer_name, email, phone, commission_type, commission_value, created_at) VALUES ('$role.$id', '$full_name', '$email', '$phone', '$commission_type', '$commission_value', '$created_at')";
        // mysqli_query($conn, $query2);

        addProfile($conn, $id, $full_name, $role, $email, $phone, 'admin', $retailer, $retailer, $commission_type, $commission_value, 'Active', $created_at);
        addCustomer($conn, $id, $full_name, $role, $email, $phone, 'admin', $retailer, $retailer, $commission_type, $commission_value, 'Active', $created_at);

        echo "Generated Password: " . generatePassword();
        $password = generatePassword();
        mailtoCustomer('Your account has been approved and you are now a user of our system. You can now login to your account and start using our services.',  $password);

        echo "<script>window.location.href = '../pending.php?success=role_assigned';</script>";
    }

    // $query = "UPDATE registration SET role = '$role', retailer_id = '$retailer' WHERE id = '$id'";
    // mysqli_query($conn, $query);
}


if (isset($_POST['declined'])) {
    $id = $_POST['id'];

    $query = "UPDATE registration SET status = 'Declined' WHERE id = '$id'";
    mysqli_query($conn, $query);

    echo "<script>window.location.href = '../pending.php?success=declined';</script>";
}

function addCustomer($conn, $id, $full_name, $role, $email, $phone, $parent, $retailer, $retailer_id, $commission_type, $commission_value, $status, $created_at)
{
    $cust_id = strtoupper($role).'0'.$id;

    $query = "INSERT INTO customer (cust_id, cust_name, cust_role, cust_email, cust_phone, parent, parent_name, parent_id, commission_type, commission_value, status, created_at) 
                            VALUES ('$cust_id', '$full_name', '$role', '$email', '$phone', '$parent', '$retailer', '$retailer_id', '$commission_type', '$commission_value', '$status', '$created_at')";
    mysqli_query($conn, $query);
}

function addProfile($conn, $id, $full_name, $role, $email, $phone, $parent, $retailer, $retailer_id, $commission_type, $commission_value, $status, $created_at)
{
    $cust_id = strtoupper($role).'0'.$id;
    $password = generatePassword();

    $query = "INSERT INTO profile (cust_id, cust_name, cust_role, cust_email, cust_phone, status, password,  created_at) 
                            VALUES ('$cust_id', '$full_name', '$role', '$email', '$phone', '$status', '$password', '$created_at')";
    mysqli_query($conn, $query);
}


function generatePassword($length = 8)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$';
    $password = '';
    $charactersLength = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $charactersLength - 1)];
    }
    return $password;
}

echo "Generated Password: " . generatePassword();




function mailtoCustomer($message, $password)
{

    // create instance of phpmailer
    $mail = new PHPMailer;
    // set mailer to use smtp
    $mail->isSMTP();
    // Timeout settings
    set_time_limit(120); // set the time limit to 120secs
    $mail->Timeout = 120; // set timeout to 120s
    // define smtp host
    $mail->Host = "smtp.hostinger.in";
    //  enable smtp authentication
    $mail->SMTPAuth = "true";
    // set type of encryption (ssl/tsl)
    $mail->SMTPSecure = "tls";
    // set port to connect smtp
    $mail->Port = "587";
    // set gmail username
    $mail->Username = "connect@techno3gamma.in";
    // set gmail password
    $mail->Password = "Brainkraft1@";
    // set email subect
    $mail->Subject = "Account Approval";
    // set sender email
    $mail->setFrom("connect@techno3gamma.in");
    // enable html
    $mail->isHTML(true);
    //Get the uploaded file information


    $mail->Body =  '<h1>' . $message . '</h1>
                    <h2> Password:' . $password . '</h2>
                    <h3>Thank you</h3>';

    // add recipient
    $mail->addAddress("sourav.deb299@gmail.com");
    $mail->addAddress("bickyaus@gmail.com");

    // send mail
    if ($mail->Send()) {
        echo "Email Sent..!";
    } else {
        echo "Error...!";
    }
    // close smtp connection.
    $mail->smtpClose();
}
