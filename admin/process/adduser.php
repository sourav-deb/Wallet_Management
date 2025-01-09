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

if (isset($_POST['add_user'])) {
    // $parent = $_POST['parent'];
    $role = $_POST['role'];
    $fullname = $_POST['fullname'];
    $comm_type = $_POST['comm_type'];
    $comm_value = $_POST['comm_value'];
    $email = $_POST['email'];
    $phone = $_POST['mobileno'];
    $address = $_POST['fulladdress'];
    $status = $_POST['status'];

    date_default_timezone_set('Asia/Kolkata');
    $created_at = date(format: 'Y-m-d H:i:s');

    // **Step 1: Prepare the SQL statement with placeholders**
    $stmt = $conn->prepare("INSERT INTO customer (cust_role, cust_name, commission_type, commission_value, cust_email, cust_phone, cust_address, status, created_at) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // **Step 2: Bind the parameters (s = string, i = integer, d = double, b = blob)**
    // Here, all the fields are strings, so we use 'sssssssss' to indicate 9 strings
    $stmt->bind_param('sssisisss', $role, $fullname, $comm_type, $comm_value, $email, $phone, $address, $status, $created_at);

    // **Step 3: Execute the statement**
    if ($stmt->execute()) {
        update_custid($conn);

        // Get the total count of rows in the 'profile' table
        $query3 = "SELECT COUNT(*) as total_rows FROM profile ";
        $result = mysqli_query($conn, $query3);
        $row = mysqli_fetch_assoc($result);
        $total_rows = $row['total_rows'];
        $total_rows++;  // Increment the total rows by 1
        $id = $total_rows;

        $password = generatePassword();
        addProfile($conn, $id, $fullname, 'RETAILER', $email, $phone, 'Active', $created_at, $password );
        mailtoCustomer('Your account has been approved and you are now a user of our system. You can now login to your account and start using our services.',  $password);
        

        echo "User added successfully!";
        header('Location: ../add_user.php?msg=success');
    } else {
        echo "Error: " . $stmt->error;
        header('Location: ../add_user.php?msg=failed');
    }

    // **Step 4: Close the statement and connection**
    $stmt->close();
}

function update_custid($conn)
{

    $sql = "UPDATE customer SET cust_id = CONCAT('RETAILER', id) WHERE id = LAST_INSERT_ID()";
    $stmt1 = $conn->prepare($sql);
    $stmt1->execute();

}

function addProfile($conn, $id, $full_name, $role, $email, $phone, $status, $created_at, $password )
{
    $cust_id = strtoupper($role) . '0' . $id;
    // $password = generatePassword();

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
