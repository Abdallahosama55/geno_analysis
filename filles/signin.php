<?php
session_start();

// Set up database connection variables
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bioserver";

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$password = $_POST['password'];
$email = $_POST['email'];
function function_alert($message) {
      

   

    echo "<script>alert('$message');</script>";
    echo "<script>window.location.href='geno.php';</script>";
    die();
}
// Prepare the SQL statement
$sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {

    $row = mysqli_fetch_assoc($result);

    if ($row['email'] === $email && $row['password'] === $password) {

        echo "Logged in!";

        $_SESSION['email'] = $row['email'];

        $_SESSION['password'] = $row['password'];

       
        header("Location:geno2.php");

        die();}}
        else{

            function_alert("Email  or password are wrong");

        }

      
?>




