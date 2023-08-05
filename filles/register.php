
<?php
// Set up database connection variables
$host = "localhost";
$username = "";
$password = "usbw";
$dbname = "bioserver";

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

function function_alert($message) {
      

   

    echo "<script>alert('$message');</script>";
    echo "<script>window.location.href='geno.php';</script>";
    die();
}
  

// Check if the email already exists in the database
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Email address already exists in the database, display an err
    
function_alert("Email already exist in database");


} else {

// Prepare the SQL statement
$sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";
}
// Execute the SQL statement
if ($conn->query($sql) === TRUE) {

    header("Location: geno2.php");
    
    die();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();

?>