<?php 
$host='localhost';
$db='user_auth';
$pass='';

$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    die("Connection failed:" .$conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 1){
    $user = $result->fetch_assoc();
    if(password_verify($password, $user['password'])){
        echo"Login successful" . $user['full_name'] . "!";

    }else{
        echo"Invalid password";
    }
}else{
    echo"No user found with that email";
}

$conn->close();
?>