<?php 
$host = 'localhost';
$db = 'user_auth';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    die("Connection failed:" . $conn->connect_error);
}

// Server-side password match validation
if($_POST['password'] !== $_POST['confirm-password']) {
    die("Passwords do not match");
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Check if email exists
$stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0) {
    die("Email already registered");
}

$sql = "INSERT INTO users (full_name, email, password) VALUES(?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $password);

if($stmt->execute()){ 
    header("Location: index.html"); // Redirect on success
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>